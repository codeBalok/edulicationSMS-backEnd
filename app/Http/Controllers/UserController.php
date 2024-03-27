<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class UserController extends Controller {

    public function login() {
        $data = [];
        $data['title'] = 'Login';
        $data['menu_active_tab'] = 'login';
        return view('admin.login')->with($data);
    }

    public function loginPost(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $admin_detail = User::where('id', \Auth::id())->first();
            if ($admin_detail) {

                $admin_detail = User::where('id', \Auth::id())->first();
                $request->session()->put('user_id', $admin_detail->id);
                $request->session()->put('role_id', $admin_detail->role_id);
                $request->session()->put('first_name', $admin_detail->first_name);
                $request->session()->put('last_name', $admin_detail->last_name);
                $request->session()->put('username', $admin_detail->username);
                $request->session()->put('email', $admin_detail->email);
                $request->session()->put('profile_image_path', $admin_detail->profile_image_path);
                $role_detail = Role::where('id', $admin_detail->role_id)->first();
                $request->session()->put('role_name', $role_detail->name);
                $initial = "";
                if ($admin_detail->first_name != null) {
                    $initial = $admin_detail->first_name[0];
                }
                if ($admin_detail->last_name != null) {
                    $initial .= $admin_detail->last_name[0];
                }
                $request->session()->put('user_initial', $initial);
            }
            $background_colors = array('bg-primary', 'bg-secondary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-dark',);
            $rand_background = $background_colors[array_rand($background_colors)];
            $request->session()->put('user_initial_color', $rand_background);

            return redirect()->intended('admin/dashboard')->withSuccess('You have Successfully loggedin');
        } else {
            if (Auth::attempt(['username' => $request->get('email'), 'password' => $request->get('password')])) {
                $admin_detail = User::where('id', \Auth::id())->first();
                $request->session()->put('user_id', $admin_detail->id);
                $request->session()->put('role_id', $admin_detail->role_id);
                $request->session()->put('first_name', $admin_detail->first_name);
                $request->session()->put('last_name', $admin_detail->last_name);
                $request->session()->put('email', $admin_detail->email);
                $request->session()->put('profile_image_path', $admin_detail->profile_image_path);
                $initial = "";
                if ($admin_detail->first_name != null) {
                    $initial = $admin_detail->first_name[0];
                }
                if ($admin_detail->last_name != null) {
                    $initial .= $admin_detail->last_name[0];
                }
                $request->session()->put('user_initial', $initial);
                $background_colors = array('bg-primary', 'bg-secondary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-dark',);
                $rand_background = $background_colors[array_rand($background_colors)];
                $request->session()->put('user_initial_color', $rand_background);

                return redirect()->intended('admin/dashboard')->withSuccess('You have Successfully loggedin');
            }
        }
        // return redirect("login")->withSuccess('Opps! You have entered invalid credentials');
        return redirect('admin/login')->with('failed', "Opps! You have entered invalid credentials");
    }

    public function logout(Request $request) {
        $request->session()->forget('user_id');
        $request->session()->forget('role_id');
        $request->session()->forget('first_name');
        $request->session()->forget('last_name');
        $request->session()->forget('email');

        \Auth::logout();
        return redirect("admin/login")->withSuccess('Logout successfully.');
    }

    public function dashboard() {
        $data = [];
        $data['title'] = 'Dashboard';
        $data['menu_active_tab'] = 'dashboard';
        $data['school'] = \App\Models\School::orderBy('id', 'DESC')->where('is_deleted', '0')->get();

        $session_role_id = \Session::get('role_id') ? \Session::get('role_id') : null;
        if ($session_role_id == 1) {
            $data['super_admin'] = \App\Models\User::where('role_id', 1)->where('is_deleted', '0')->orderBy('id', 'DESC')->get();

            return view('admin.super_admin_dashboard')->with($data);
        } else {
            return view('admin.dashboard')->with($data);
        }
    }

    public function userList() {
        $data = [];
        $data['title'] = 'User List';
        $data['menu_active_tab'] = 'user-list';
        $user = \App\Models\User::select('users.id', 'role_id', 'first_name', 'last_name', 'email', 'users.created_at')->orderBy('users.id', 'DESC')
                ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
                ->where('users.is_deleted', '0')
                ->get();

        $data['user'] = $user;
        return view('admin.user.list')->with($data);
    }

    public function addUser(Request $request) {
        $data = [];
        $data['title'] = 'Add User';
        $data['menu_active_tab'] = 'add-user';
        $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();

        return view('admin.user.add')->with($data);
    }

    public function storeUser(Request $request) {

        $this->validate($request, [
            'first_name' => 'required|string|min:4|max:255',
            'city_name' => 'required|string|min:4|max:255',
            'email' => 'required|string|email|max:255|unique:users,email'
        ]);

        $data = $request->input();
        try {
            $user = new \App\Models\User();
            $user->first_name = isset($data['first_name']) ? $data['first_name'] : null;
            $user->middle_name = isset($data['middle_name']) ? $data['middle_name'] : null;
            $user->last_name = isset($data['last_name']) ? $data['last_name'] : null;
            $user->email = isset($data['email']) ? $data['email'] : null;
            $user->username = isset($data['username']) ? $data['username'] : null;
            $user->role_id = isset($data['role_id']) ? $data['role_id'] : null;
            $user->gender = isset($data['gender']) ? $data['gender'] : 1;
            $user->save();
            $this->sendRegisterLinkEmail($user->email);
//                 $to      =$user->email ;// 'nobody@example.com';
//    $subject = 'the subject';
//    $message = 'hello';
//    $headers = 'From: webmaster@example.com'       . "\r\n" .
//                 'Reply-To: webmaster@example.com' . "\r\n" .
//                 'X-Mailer: PHP/' . phpversion();
//
//    mail($to, $subject, $message, $headers);

            return redirect()->route('user-list')->with('success', 'Record added successfully.');
        } catch (Exception $e) {
            return redirect()->route('user-list')->with('failed', 'Record not added.');
        }
    }

    public function editUser(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit User';
        $data['menu_active_tab'] = 'user-list';
        if ($id) {
            $user = User::find($id);
            $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            if ($user) {
                $data['user'] = $user;
                return view('admin.user.edit')->with($data);
            } else {
                return redirect()->route('user-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('user-list')->with('failed', 'Record not found.');
        }
    }

    public function updateUser(Request $request, $id) {
        if ($id) {
            $request->validate([
                'first_name' => 'required',
//                'last_name' => 'required',
//                'email' => 'required',
//                'mobile_no' => 'required',
            ]);
            $data = $request->input();
            $user = User::find($id);
            if ($user) {
                $user->first_name = isset($data['first_name']) ? $data['first_name'] : null;
                $user->middle_name = isset($data['middle_name']) ? $data['middle_name'] : null;
                $user->last_name = isset($data['last_name']) ? $data['last_name'] : null;
                $user->email = isset($data['email']) ? $data['email'] : null;
                $user->username = isset($data['username']) ? $data['username'] : null;
                $user->role_id = isset($data['role_id']) ? $data['role_id'] : null;
                $user->gender = isset($data['gender']) ? $data['gender'] : 1;
                //profile_image
                $file_name = null;
                $file_path = null;
                if ($request->file()) {
                    $file_name = 'profile_image' . time() . '.' . $request->profile_image->extension();
                    $file_path = $request->file('profile_image')->storeAs('profile_image', $file_name, 'public');
                }
                if ($file_name != null) {
                    $user->profile_image = $file_name;
                }
                if ($file_path != null) {
                    $user->profile_image_path = $file_path;
                }
//                $user->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $user->save();
            }
            return redirect()->route('user-list')->with('success', 'Record Updated.');
        } else {
            return redirect()->route('user-list')->with('failed', 'Record not found.');
        }
    }

    public function deleteUser($id) {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $user->is_deleted = '1';
                //  $user->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $user->save();
            }

            return redirect()->route('user-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('user-list')->with('failed', 'Record not found.');
        }
    }

    public function editUserProfile() {
        $data = [];
        $data['title'] = 'Edit User Profile';
        $data['menu_active_tab'] = 'dashboard';
        if (\Auth::id()) {
            $user = User::where('id', \Auth::id())->first();
            if ($user) {
                $data['user'] = $user;
                $data['user_role'] = Role::where('id', $user->role_id)->first();
                return view('admin.edit_user_profile')->with($data);
            } else {
                return redirect()->route('dashboard')->with('failed', "Record not found");
            }
        } else {
            return redirect()->route('dashboard')->with('failed', "Record not found");
        }
    }

    public function updateUserProfile(Request $request) {
        if (\Auth::id()) {
            $request->validate([
                'first_name' => 'required',
//                'last_name' => 'required',
                'email' => 'required',
//                'mobile_no' => 'required',
            ]);
            $user = User::find(\Auth::id());
            if ($user) {
                //profile_image
                $file_name = null;
                $file_path = null;
                if ($request->file()) {
                    $file_name = 'profile_image' . time() . '.' . $request->profile_image->extension();
                    $file_path = $request->file('profile_image')->storeAs('profile_image', $file_name, 'public');
                }

                $user->first_name = $request->input('first_name');
                $user->middle_name = $request->input('middle_name');
                $user->last_name = $request->input('last_name');
                $user->username = $request->input('username');
                $user->email = $request->input('email');
//                $user->mobile_no = $request->input('mobile_no');

                if ($file_name != null) {
                    $user->profile_image = $file_name;
                }
                if ($file_path != null) {
                    $user->profile_image_path = $file_path;
                    $request->session()->put('profile_image_path', $file_path);
                }

                $request->session()->put('first_name', $request->input('first_name'));
                $request->session()->put('last_name', $request->input('last_name'));
                $request->session()->put('email', $request->input('email'));

                $user->save();
            }
            return redirect()->route('edit-user-profile')->with('success', 'User Profile Updated.');
        } else {
            return redirect()->route('dashboard')->with('failed', "Record not found");
        }
    }

    public function userChangePassword() {
        $data = [];
        $data['title'] = 'Change Password';
        $data['menu_active_tab'] = 'dashboard';
        if (\Auth::id()) {
            $user = User::where('id', \Auth::id())->first();
            if ($user) {
                $data['user'] = $user;
                return view('admin.user-change-password')->with($data);
            } else {
                return redirect()->route('dashboard')->with('failed', "Record not found");
            }
        } else {
            return redirect()->route('dashboard')->with('failed', "Record not found");
        }
    }

    public function userUpdatePassword(Request $request) {
        if (\Auth::id()) {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required|same:new_password'
            ]);
            #Match The Old Password
            if (!Hash::check($request->old_password, auth()->user()->password)) {
                return back()->with("error", "Old Password Doesn't match!");
            }

            $user = User::find(\Auth::id());
            if ($user) {
                $user->password = bcrypt($request->get('new_password'));
                $user->save();
            }
            return redirect()->route('user-change-password')->with('success', 'User Password Updated.');
        } else {
            return redirect()->route('dashboard')->with('failed', "Record not found");
        }
    }

    public function forgotPassword() {
        $data = [];
        $data['title'] = 'Forgot Password';
        $data['menu_active_tab'] = '';
        try {
            return view('admin.forgot-password')->with($data);
        } catch (Exception $e) {
            return redirect()->route('login')->with('failed', "Record not found");
        }
    }

    public function forgotPasswordPost(Request $request) {
        try {
            $request->validate([
                'email' => 'required',
            ]);
            $email = $request->email;
            $user = User::where('email', $email)->first();
            if ($user) {
                $token = Str::random(64);

                \App\Models\PasswordReset::where('email', $email)->delete();

                $password_reset = new \App\Models\PasswordReset;
                $password_reset->user_id = $user->id;
                $password_reset->email = $email;
                $password_reset->token = $token;
                $password_reset->save();
                $to = $email;
                $subject = 'Forgot Password Detail';
                $link = url('') . '/reset-password/' . $token;
                $message = ' <table>
                           <tr>
                          <td>Hello ' . $user->first_name . ' ' . $user->last_name . ',  </td>
                        </tr>
                        <tr>
                          <td>You can reset your password using <a href="' . $link . '" style="color:blue;text-decoration: underline;font-weight: bold;">this link</a>. This link is active for one time use only within 24 hours.</td>
                        </tr>
                         <tr>
                        </tr>
                      </table>';
                $headers = 'From: industrdev@gmail.com' . "\r\n" .
                        'Reply-To: industrdev@gmail.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                $headers .= "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                $res = mail($to, $subject, $message, $headers);

                return redirect()->route('forgot-password')->with('success', 'Email Send.');
            } else {
                return redirect()->route('forgot-password')->with('failed', "Record not found");
            }
        } catch (Exception $e) {
            return redirect()->route('forgot-password')->with('failed', "Record not found");
        }
    }

    public function resetPassword($token) {
        if ($token) {
            $user = \App\Models\PasswordReset::where('token', $token)->first();

            if (!$user) {
                \Session::flash('failed', 'Link already has been expired');
                return redirect()->route('login')->with('failed', "Link already has been expired");
            } else {
                $created_at_date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('Y-m-d H:i:s');
                $current_date = strtotime(date("Y-m-d H:i:s"));
                $date = strtotime($created_at_date);
                $datediff = $current_date - $date;
                $difference = floor($datediff / (60 * 60 * 24));
                if ($difference == 0) {
                    return view('admin.reset-password', compact('token'));
                } else {
                    return redirect()->route('login')->with('failed', "Your verification link has expired. Please resend.");
                }
            }
        } else {
            return redirect()->route('login')->with('failed', 'Invalid link. Please try again.');
        }
    }

    public function resetPasswordPost(Request $request) {
        try {
            $request->validate([
                'new_password' => 'required',
                'confirm_password' => 'required|same:new_password'
            ]);
            $token = $request->token;
            $reset_password = \App\Models\PasswordReset::where('token', $token)->first();
            if (!$reset_password) {
                return redirect()->route('login')->with('failed', "User not found");
            } else {
                if ($reset_password->email != null) {
                    $user = User::where('email', $reset_password->email)
                            ->where('id', $reset_password->user_id)
                            ->first();
                    if ($user) {
                        $user->password = bcrypt($request->new_password);
                        $user->save();
                        \App\Models\PasswordReset::where('email', $reset_password->email)->delete();
                        return redirect()->route('login')->with('success', 'Password saved successfully.');
                    } else {
                        return redirect()->route('login')->with('failed', "Record not found");
                    }
                }
            }
        } catch (Exception $e) {
            return redirect()->route('login')->with('failed', "Record not found");
        }
    }

    public function getArticleLoadMore(Request $request) {
        $page_no = 2;
        if (isset($request->page_no)) {
            $page_no = (int) $request->input('page_no');
        }
        $per_page = 3;
        $curr_page_id = $page_no;
        $range1 = $page_no;
        $range2 = $range1 - 1;
        if ($page_no == 1) {
            $range_limit = 0;
        } else {
            $range3 = $range2 * 3;
            $range_limit = $range3;
        }
        $total_items = \App\Models\Content::select('content.id')
                        ->where('content.is_deleted', '0')
                        ->orderBy('content.id', 'DESC')
                        ->get()->count();
        $total_pages = ceil($total_items / $per_page);
        $content_record = \App\Models\Content::where('is_deleted', '0')->orderBy('id', 'DESC')->limit($per_page)->offset($range_limit)
                ->get();
        $content_arr = array();

        if ($content_record) {
            foreach ($content_record as $key => $value) {

                if ($value->created_by_id != null) {
                    $user_created_by_id = User::select(
                                    'users.first_name',
                                    'users.last_name',
                                    'users.profile_image_path',
                                    'role.name as role_name'
                            )
                            ->where('users.id', $value->created_by_id)
                            ->leftJoin('role', 'users.role_id', '=', 'role.id')
                            ->where('users.is_deleted', '0')
                            ->first();
                }
                $video_type_id_value = '';
                $video_type_id_path = '';
                if ($value->content_image_video_type != null) {
                    if ($value->content_image_video_type == 1) {
                        $video_type_id_value = 'Image';
                        $artical_image_path = "";
                        if ($value->artical_image_path != null) {
//                            $artical_image_path = asset('storage/' . $value->artical_image_path);
                            $artical_image_path = getStoragePath() . $value->artical_image_path;
                        }
                        $video_type_id_path = $artical_image_path;
                    }
                    if ($value->content_image_video_type == 2) {
                        $video_type_id_value = 'Video';
                        $artical_video_url_link = "";
                        if ($value->artical_video_url_link != null) {
                            $artical_video_url_link = $value->artical_video_url_link;
                        }
                        $video_type_id_path = $artical_video_url_link;
                    }
                }
                if ($value->video_type_id != null) {
                    if ($value->video_type_id == 1) {
                        $video_type_id_value = 'Video';
                        $artical_video_path = "";
                        if ($value->artical_video_path != null) {
//                            $artical_video_path = asset('storage/' . $value->artical_video_path);
                            $artical_video_path = getStoragePath() . $value->artical_video_path;
                        }
                        $video_type_id_path = $artical_video_path;
                    }
                    if ($value->video_type_id == 2) {
                        $video_type_id_value = 'Link';
                        $artical_video_url_link = "";
                        if ($value->artical_video_url_link != null) {
                            $artical_video_url_link = $value->artical_video_url_link;
                        }
                        $video_type_id_path = $artical_video_url_link;
                    }
                }
                $initial = "";
                if (isset($user_created_by_id) && $user_created_by_id->first_name != null) {
                    $initial = $user_created_by_id->first_name[0];
                }
                if (isset($user_created_by_id) && $user_created_by_id->last_name != null) {
                    $initial .= $user_created_by_id->last_name[0];
                }

                $background_colors = array('bg-primary', 'bg-secondary', 'bg-secondary', 'bg-success', 'bg-danger', 'bg-warning', 'bg-info', 'bg-dark',);
                $rand_background = $background_colors[array_rand($background_colors)];

                $arr = array(
                    'id' => $value->id,
                    'title' => $value->title,
                    'created_by_name' => isset($user_created_by_id) ? $user_created_by_id->first_name . " " . $user_created_by_id->last_name : '-',
                    'created_by_role_name' => isset($user_created_by_id) ? $user_created_by_id->role_name : '-',
                    'created_by_profile_image_path' => isset($user_created_by_id) ? $user_created_by_id->profile_image_path : '',
                    'created_by_user_initial' => $initial ? $initial : '',
                    'created_by_initial_color' => $rand_background ? $rand_background : '',
                    'created_at_time' => $value->created_at ? date("d-M-Y", strtotime($value->created_at)) : '-',
                    'video_type_id_value' => $video_type_id_value ? $video_type_id_value : '',
                    'video_type_id_path' => $video_type_id_path ? $video_type_id_path : '',
                );
                $content_arr[] = $arr;
            }
        }
        try {
            $html = \View::make('admin.article_activity_timeline', [
                        'content_arr' => $content_arr,
                        'pageno' => $page_no
                    ])->render();
            if ($total_pages > $page_no) {
                $next_page_no = $page_no + 1;
            } else {
                $next_page_no = $page_no;
            }
            return json_encode(array('status' => true, 'next_page_no' => $next_page_no, 'total_pages' => $total_pages, 'html' => $html));
        } catch (Exception $e) {
            return redirect()->route('login')->with('failed', "Record not found");
        }
    }

    public function addSuperAdmin(Request $request) {
        $data = [];
        $data['title'] = 'Add User';
        $data['menu_active_tab'] = 'add-user';
        $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();

        return view('admin.super_admin.add')->with($data);
    }

    public function storeSuperAdmin(Request $request) {

        $this->validate($request, [
            'first_name' => 'required|string|min:1|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username'
        ]);

        $data = $request->input();
        try {
            $user = new \App\Models\User();
            $user->first_name = isset($data['first_name']) ? $data['first_name'] : null;
            $user->last_name = isset($data['last_name']) ? $data['last_name'] : null;
            $user->email = isset($data['email']) ? $data['email'] : null;
            $user->username = isset($data['username']) ? $data['username'] : null;
            $user->role_id = 1;
            $user->gender = isset($data['gender']) ? $data['gender'] : 1;
            $user->password = isset($data['password']) ? Hash($data['password']) : null;
            $user->save();

            $this->sendRegisterLinkEmail($user->email);

            return redirect()->route('super-admin-list')->with('success', 'Record added successfully.');
        } catch (Exception $e) {
            return redirect()->route('super-admin-list')->with('failed', 'Record not added.');
        }
    }

    public function superAdminList() {
        $data = [];
        $data['title'] = 'Super Admin List';
        $data['menu_active_tab'] = 'super-admin-list';
        $user = \App\Models\User::select('users.id', 'role_id', 'first_name', 'last_name', 'email', 'users.created_at')->orderBy('users.id', 'DESC')
                ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
                ->where('users.role_id', '1')->where('users.is_deleted', '0')
                ->get();
        // dd($user);
        $data['user'] = $user;
        return view('admin.super_admin.list')->with($data);
    }

    public function editSuperAdmin(Request $request, $id) {
        $data = [];
        $data['title'] = 'Edit Super Admin';
        $data['menu_active_tab'] = 'super-admin-list';
        if ($id) {
            $user = User::find($id);
            $data['role'] = Role::where('is_deleted', '0')->where('id', '!=', '1')->orderBy('id', 'ASC')->get();
            if ($user) {
                $data['user'] = $user;
                return view('admin.super_admin.edit')->with($data);
            } else {
                return redirect()->route('super-admin-list')->with('failed', 'Record not found.');
            }
        } else {
            return redirect()->route('super-admin-list')->with('failed', 'Record not found.');
        }
    }

    public function deleteSuperAdmin($id) {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $user->is_deleted = '1';
                //  $user->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $user->save();
            }
            return redirect()->route('super-admin-list')->with('success', 'Record deleted.');
        } else {
            return redirect()->route('super-admin-list')->with('failed', 'Record not found.');
        }
    }

    public function updateSuperAdmin(Request $request, $id) {

        if ($id) {
            $request->validate([
                'first_name' => 'required|string|min:1|max:255',
                'last_name' => 'required|string|min:1|max:255',
                'email' => 'required|string|email|max:255|unique:users,email,' . $id,
                'username' => 'required|string|max:255|unique:users,username,' . $id,
            ]);
            $data = $request->input();
            $user = User::find($id);
            if ($user) {
                $user->first_name = isset($data['first_name']) ? $data['first_name'] : null;
                $user->middle_name = isset($data['middle_name']) ? $data['middle_name'] : null;
                $user->last_name = isset($data['last_name']) ? $data['last_name'] : null;
                $user->email = isset($data['email']) ? $data['email'] : null;
                $user->username = isset($data['username']) ? $data['username'] : null;
                $user->gender = isset($data['gender']) ? $data['gender'] : 1;
                //profile_image
//                $file_name = null;
//                $file_path = null;
//                if ($request->file()) {
//                    $file_name = 'profile_image' . time() . '.' . $request->profile_image->extension();
//                    $file_path = $request->file('profile_image')->storeAs('profile_image', $file_name, 'public');
//                }
//                $user->mobile_no = $request->input('mobile_no');
//                if ($file_name != null) {
//                    $user->profile_image = $file_name;
//                }
//                if ($file_path != null) {
//                    $user->profile_image_path = $file_path;
//                }
//                $user->modified_by_id = \Auth::user()->id ? \Auth::user()->id : null;
                $user->save();
            }
            return redirect()->route('super-admin-list')->with('success', 'Record Updated.');
        } else {
            return redirect()->route('super-admin-list')->with('failed', 'Record not found.');
        }
    }

    public function sendRegisterLinkEmail($to) {
        if ($to) {
            $subject = "Register User Email";
            $encode_to = base64_encode($to);
            $message = "<b>Register User Email</b>";
            $message .= "<br>";
            $message .= "http://edulication.nalandagroup.org/api/verify-email/" . $encode_to;
            $message .= "<br>";
            $message .= "Please click on link and set password ";

            $header = "From:edulication@edulication.com \r\n";
            //  $header .= "Cc:afgh@somedomain.com \r\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-type: text/html\r\n";

            $retval = mail($to, $subject, $message, $header);
        }
        //  if( $retval == true ) {
        //     echo "Message sent successfully...";
        //  }else {
        //     echo "Message could not be sent...";
        //  }
    }

}
