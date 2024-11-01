<?php

namespace App\Helper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use DOMDocument;

class SoapHelper
{

    const NS_ADDR = 'http://www.w3.org/2005/08/addressing';
    const NS_ADDR_PREFIX = 'a';
    const NS_ASSR = 'urn:oasis:names:tc:SAML:2.0:assertion';
    const NS_ASSR_PREFIX = 'assr';
    const NS_EXC = 'http://www.w3.org/2001/10/xml-exc-c14n#';
    const NS_EXC_PREFIX = 'exc14n';
    const NS_SOAP = 'http://www.w3.org/2003/05/soap-envelope';
    const NS_SOAP_PREFIX = 's';
    const NS_SEC = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';
    const NS_SEC_PREFIX = 'o';
    const NS_SEXT = 'http://docs.oasis-open.org/wss/oasis-wss-wssecurity-secext-1.1.xsd';
    const NS_SEXT_PREFIX = 'wsse11';
    const NS_SIGN = 'http://www.w3.org/2000/09/xmldsig#';
    const NS_SIGN_PREFIX = 'ds';
    const NS_WST = 'http://docs.oasis-open.org/ws-sx/ws-trust/200512';
    const NS_WST_PREFIX = 'trust';
    const NS_USI = 'http://usi.gov.au/2022/ws';
    const NS_USI_PREFIX = 'ws';
    const NS_WSP = 'http://schemas.xmlsoap.org/ws/2004/09/policy';
    const NS_WSP_PREFIX = 'wsp';
    const NS_WSU = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd';
    const NS_WSU_PREFIX = 'u';
    const NS_XENC = 'http://www.w3.org/2001/04/xmlenc#';
    const NS_XENC_PREFIX = 'xe';
    const NS_USE = 'http://usi.gov.au/2015/ws';
    const NS_USE_PREFIX = 'u';
    const NS_TR = 'http://docs.oasis-open.org/ws-sx/ws-trust/200802';
    const NS_TR_PREFIX = 'tr';
    const NS_V13 = 'http://vanguard.business.gov.au/2016/03';
    const NS_V13_PREFIX = 'v13';

    protected $doc;
    protected $wsdl = null; // to be defined automatically
    protected $wsdl_live = null; // to be overridden
    protected $wsdl_test = null; // to be overridden
    protected $message_id;
    protected $token_id;
    protected $created_datetime;
    protected $expires_datetime;

    public function __construct($test = false)
    {
        $this->token_id = uniqid('uuid-');
        $myvar = $this->guidv4();
        $this->message_id = 'urn:uuid:' . $myvar;
        $created_when = time() - 9; // Set creation to 1 minute prior
        $this->created_datetime = gmdate('Y-m-d', $created_when) . 'T' . gmdate('H:i:s', $created_when) . '.000Z';
        $expires_when = time() + 300;
        $this->expires_datetime = gmdate('Y-m-d', $expires_when) . 'T' . gmdate('H:i:s', $expires_when) . '.000Z';
//        $expired_when = time() + 1800;
//        $this->expired_datetime = gmdate('Y-m-d', $expired_when) . 'T' . gmdate('H:i:s', $expired_when) . '.000Z';
        $this->doc = new DOMDocument('1.0', 'UTF-8');
    }

    public function guidv4()
    {
        // Produce a unique message id with a GUID
        if (function_exists('com_create_guid') === true)
            return trim(com_create_guid(), '{}');

        $data = openssl_random_pseudo_bytes(16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }

    protected function isTest()
    {
        return ($this->wsdl == $this->wsdl_test);
    }

    protected function canonicalize($xml, $xpath = null, $ns_prefixes = null)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);
        return $dom->C14N(true, false, $xpath, $ns_prefixes);
    }

    protected function buildTimestampHeader($id = '_0')
    {
        $ts = $this->doc->createElementNS(self::NS_WSU, self::NS_WSU_PREFIX . ':Timestamp');
        $ts->setAttributeNS(self::NS_WSU, self::NS_WSU_PREFIX . ':Id', $id);
        $ts->appendChild($this->doc->createElementNS(self::NS_WSU, self::NS_WSU_PREFIX . ':Created', $this->created_datetime));
        $ts->appendChild($this->doc->createElementNS(self::NS_WSU, self::NS_WSU_PREFIX . ':Expires', $this->expires_datetime));
        return $ts;
    }

    protected function buildTo($url)
    {
        $to = $this->doc->createElementNS(self::NS_ADDR, self::NS_ADDR_PREFIX . ':To', $url);
        $to->setAttributeNS(self::NS_SOAP, self::NS_SOAP_PREFIX . ':mustUnderstand', 1);
        $to->setAttributeNS(self::NS_WSU, self::NS_WSU_PREFIX . ':Id', '_1');
        return $to;
    }

    protected function sendSoapRequest($action, $xml, $url)
    {
        // Set the headers for the SOAP request
        $headers = [
            'SOAPAction' => $action,
            'Connection' => 'Keep-Alive',
            'Content-Type' => 'application/soap+xml; charset=utf-8',
            'User-Agent' => 'Apache-HttpClient/4.5.3 (Java/1.8.0_121)',
        ];

        // Determine if we are in TEST mode for SSL verification
        $verifySSL = config('usi.mode') === 'TEST' ? false : true;

        // Create a new Guzzle client
        $client = new Client([
            'base_uri' => $url,
            'timeout' => 60, // seconds
            'connect_timeout' => 60, // seconds
            'headers' => $headers,
            'verify' => $verifySSL, // Enables/Disables SSL verification
        ]);

        try {
            // Send the SOAP request
            $response = $client->post($url, [
                'body' => $xml, // XML body content
            ]);

            // Check HTTP response status
            $statusCode = $response->getStatusCode();

            // Throw exception if status code is 400 (Bad request)
            if ($statusCode === 400) {
                throw new \Exception('HTTP 400 - Bad Request');
            }

            // Return the response body
            return $response->getBody()->getContents();

        } catch (RequestException $e) {
            // Handle request exceptions (like cURL errors)
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                  // Log the error details
                \Log::error('SOAP request failed', [
                    'message' => $e->getMessage(),
                    'request_body' => $xml,
                    'response' => isset($response) ? $response->getBody()->getContents() : null,
                ]);
                $statusCode = $response->getStatusCode();
                throw new \Exception('HTTP error: ' . $statusCode . ' - ' . $response->getReasonPhrase());
            } else {
                throw new \Exception('Request error: ' . $e->getMessage());
            }
        }
    }
}