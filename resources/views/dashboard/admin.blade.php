<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@if(Session::has('validUser') && Session::get('validUser') == 'true')



<div class="container">
    	<div class="row">
			<div class="col-md-12">
				<div class="panel panel-success">
                	<span class="pull-right"><a href="">Logout</a></span>
					<div class="panel-heading">
						<h3 class="panel-title">SEO settings</h3>
                    </div>
                    {{ Form::open(['url'=>url('update_seo'), 'role'=>'form','method'=>'post','class'=>'form-horizontal']) }}
					<table class="table table-hover" id="task-table">
						<thead>
							<tr>
								<th>#</th>
								<th>Field Name</th>
								<th>Value</th>
							</tr>
						</thead>
						<tbody>
                        	
                            <tr>
                            	<td colspan="3"><strong>EN</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[us]" value="{{isset($data['title']['us']) ? $data['title']['us'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[us]" value="{{isset($data['keyword']['us']) ? $data['keyword']['us'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[us]" value="{{isset($data['description']['us']) ? $data['description']['us'] : ''}}"></td>
							</tr>
                            <tr>
                            	<td colspan="3"><strong>ZH</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[zh]" value="{{isset($data['title']['zh']) ? $data['title']['zh'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[zh]" value="{{isset($data['keyword']['zh']) ? $data['keyword']['zh'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[zh]" value="{{isset($data['description']['zh']) ? $data['description']['zh'] : ''}}"></td>
							</tr>
                            
                            <tr>
                            	<td colspan="3"><strong>ES</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[es]" value="{{isset($data['title']['es']) ? $data['title']['es'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[es]" value="{{isset($data['keyword']['es']) ? $data['keyword']['es'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[es]" value="{{isset($data['description']['es']) ? $data['description']['es'] : ''}}"></td>
							</tr>
                            
                            <tr>
                            	<td colspan="3"><strong>PT</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[pt]" value="{{isset($data['title']['pt']) ? $data['title']['pt'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[pt]" value="{{isset($data['keyword']['pt']) ? $data['keyword']['pt'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[pt]" value="{{isset($data['description']['pt']) ? $data['description']['pt'] : ''}}"></td>
							</tr>
                            
                            <tr>
                            	<td colspan="3"><strong>RU</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[ru]" value="{{isset($data['title']['ru']) ? $data['title']['ru'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[ru]" value="{{isset($data['keyword']['ru']) ? $data['keyword']['ru'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[ru]" value="{{isset($data['description']['ru']) ? $data['description']['ru'] : ''}}"></td>
							</tr>
                            
                            <tr>
                            	<td colspan="3"><strong>ID</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[id]" value="{{isset($data['title']['id']) ? $data['title']['id'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[id]" value="{{isset($data['keyword']['id']) ? $data['keyword']['id'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[id]" value="{{isset($data['description']['id']) ? $data['description']['id'] : ''}}"></td>
							</tr>
                            
                            <tr>
                            	<td colspan="3"><strong>FR</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[fr]" value="{{isset($data['title']['fr']) ? $data['title']['fr'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[fr]" value="{{isset($data['keyword']['fr']) ? $data['keyword']['fr'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[fr]" value="{{isset($data['description']['fr']) ? $data['description']['fr'] : ''}}"></td>
							</tr>
                            
                            <tr>
                            	<td colspan="3"><strong>DE</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[de]" value="{{isset($data['title']['de']) ? $data['title']['de'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[de]" value="{{isset($data['keyword']['de']) ? $data['keyword']['de'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[de]" value="{{isset($data['description']['de']) ? $data['description']['de'] : ''}}"></td>
							</tr>
                            
                            <tr>
                            	<td colspan="3"><strong>JA</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[ja]" value="{{isset($data['title']['ja']) ? $data['title']['ja'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[ja]" value="{{isset($data['keyword']['ja']) ? $data['keyword']['ja'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[ja]" value="{{isset($data['description']['ja']) ? $data['description']['ja'] : ''}}"></td>
							</tr>
                            
                            <tr>
                            	<td colspan="3"><strong>NL</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[nl]" value="{{isset($data['title']['nl']) ? $data['title']['nl'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[nl]" value="{{isset($data['keyword']['nl']) ? $data['keyword']['nl'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[nl]" value="{{isset($data['description']['nl']) ? $data['description']['nl'] : ''}}"></td>
							</tr>
                            
                            <tr>
                            	<td colspan="3"><strong>PL</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[pl]" value="{{isset($data['title']['pl']) ? $data['title']['pl'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[pl]" value="{{isset($data['keyword']['pl']) ? $data['keyword']['pl'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[pl]" value="{{isset($data['description']['pl']) ? $data['description']['pl'] : ''}}"></td>
							</tr>
                            
                            <tr>
                            	<td colspan="3"><strong>TR</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[tr]" value="{{isset($data['title']['tr']) ? $data['title']['tr'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[tr]" value="{{isset($data['keyword']['tr']) ? $data['keyword']['tr'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[tr]" value="{{isset($data['description']['tr']) ? $data['description']['tr'] : ''}}"></td>
							</tr>
                            <tr>
                            	<td colspan="3"><strong>KO</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[ko]" value="{{isset($data['title']['ko']) ? $data['title']['ko'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[ko]" value="{{isset($data['keyword']['ko']) ? $data['keyword']['ko'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[ko]" value="{{isset($data['description']['ko']) ? $data['description']['ko'] : ''}}"></td>
							</tr>
                            
                            
                            <tr>
                            	<td colspan="3"><strong>IT</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[it]" value="{{isset($data['title']['it']) ? $data['title']['it'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[it]" value="{{isset($data['keyword']['it']) ? $data['keyword']['it'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[it]" value="{{isset($data['description']['it']) ? $data['description']['it'] : ''}}"></td>
							</tr>
                            
                            
                            <tr>
                            	<td colspan="3"><strong>VI</strong></td>
                            </tr>
							<tr>
								<td>1</td>
								<td>SEO Title</td>
								<td><input name="title[vi]" value="{{isset($data['title']['vi']) ? $data['title']['vi'] : ''}}"></td>
							</tr>
                            <tr>
								<td>2</td>
								<td>SEO Keywords</td>
								<td><input name="keyword[vi]" value="{{isset($data['keyword']['vi']) ? $data['keyword']['vi'] : ''}}"></td>
							</tr>
                            <tr>
								<td>3</td>
								<td>SEO Description</td>
								<td><input name="description[vi]" value="{{isset($data['description']['vi']) ? $data['description']['vi'] : ''}}"></td>
							</tr>
                           
 
                            
                            
                            <tr>
								<td colspan="3" align="center"><input type="submit" value="Update"></td>
							</tr>
                    	</tbody>
					</table>
                    {{ Form::close() }}
				</div>
			</div>
		</div>
	</div>










@else
@if(sizeof($errors->all()) > 0)
<div class="alert alert-danger">
  <strong>Error!!</strong> 
    @foreach($errors->all() as $error)
    <p>{{$error}}</p>
    @endforeach
</div>
@endif
<style>
/*------------------------------------------------------------------
[Master Stylesheet]

Project    	: Aether
Version		: 1.0
Last change	: 2015/03/27
-------------------------------------------------------------------*/
/*------------------------------------------------------------------
[Table of contents]

1. General Structure
2. Anchor Link
3. Text Outside the Box
4. Main Form
5. Login Button
6. Form Invalid
7. Form - Main Message
8. Custom Checkbox & Radio
9. Misc
-------------------------------------------------------------------*/
/*=== 1. General Structure ===*/
html,
body {
  background: #efefef;
  padding: 10px;
  font-family: 'Varela Round';
}
/*=== 2. Anchor Link ===*/
a {
  color: #aaaaaa;
  transition: all ease-in-out 200ms;
}
a:hover {
  color: #333333;
  text-decoration: none;
}
/*=== 3. Text Outside the Box ===*/
.etc-login-form {
  color: #919191;
  padding: 10px 20px;
}
.etc-login-form p {
  margin-bottom: 5px;
}
/*=== 4. Main Form ===*/
.login-form-1 {
  max-width: 300px;
  border-radius: 5px;
  display: inline-block;
}
.main-login-form {
  position: relative;
}
.login-form-1 .form-control {
  border: 0;
  box-shadow: 0 0 0;
  border-radius: 0;
  background: transparent;
  color: #555555;
  padding: 7px 0;
  font-weight: bold;
  height:auto;
}
.login-form-1 .form-control::-webkit-input-placeholder {
  color: #999999;
}
.login-form-1 .form-control:-moz-placeholder,
.login-form-1 .form-control::-moz-placeholder,
.login-form-1 .form-control:-ms-input-placeholder {
  color: #999999;
}
.login-form-1 .form-group {
  margin-bottom: 0;
  border-bottom: 2px solid #efefef;
  padding-right: 20px;
  position: relative;
}
.login-form-1 .form-group:last-child {
  border-bottom: 0;
}
.login-group {
  background: #ffffff;
  color: #999999;
  border-radius: 8px;
  padding: 10px 20px;
}
.login-group-checkbox {
  padding: 5px 0;
}
/*=== 5. Login Button ===*/
.login-form-1 .login-button {
  position: absolute;
  right: -25px;
  top: 50%;
  background: #ffffff;
  color: #999999;
  padding: 11px 0;
  width: 50px;
  height: 50px;
  margin-top: -25px;
  border: 5px solid #efefef;
  border-radius: 50%;
  transition: all ease-in-out 500ms;
}
.login-form-1 .login-button:hover {
  color: #555555;
  transform: rotate(450deg);
}
.login-form-1 .login-button.clicked {
  color: #555555;
}
.login-form-1 .login-button.clicked:hover {
  transform: none;
}
.login-form-1 .login-button.clicked.success {
  color: #2ecc71;
}
.login-form-1 .login-button.clicked.error {
  color: #e74c3c;
}
/*=== 6. Form Invalid ===*/
label.form-invalid {
  position: absolute;
  top: 0;
  right: 0;
  z-index: 5;
  display: block;
  margin-top: -25px;
  padding: 7px 9px;
  background: #777777;
  color: #ffffff;
  border-radius: 5px;
  font-weight: bold;
  font-size: 11px;
}
label.form-invalid:after {
  top: 100%;
  right: 10px;
  border: solid transparent;
  content: " ";
  height: 0;
  width: 0;
  position: absolute;
  pointer-events: none;
  border-color: transparent;
  border-top-color: #777777;
  border-width: 6px;
}
/*=== 7. Form - Main Message ===*/
.login-form-main-message {
  background: #ffffff;
  color: #999999;
  border-left: 3px solid transparent;
  border-radius: 3px;
  margin-bottom: 8px;
  font-weight: bold;
  height: 0;
  padding: 0 20px 0 17px;
  opacity: 0;
  transition: all ease-in-out 200ms;
}
.login-form-main-message.show {
  height: auto;
  opacity: 1;
  padding: 10px 20px 10px 17px;
}
.login-form-main-message.success {
  border-left-color: #2ecc71;
}
.login-form-main-message.error {
  border-left-color: #e74c3c;
}
/*=== 8. Custom Checkbox & Radio ===*/
/* Base for label styling */
[type="checkbox"]:not(:checked),
[type="checkbox"]:checked,
[type="radio"]:not(:checked),
[type="radio"]:checked {
  position: absolute;
  left: -9999px;
}
[type="checkbox"]:not(:checked) + label,
[type="checkbox"]:checked + label,
[type="radio"]:not(:checked) + label,
[type="radio"]:checked + label {
  position: relative;
  padding-left: 25px;
  padding-top: 1px;
  cursor: pointer;
}
/* checkbox aspect */
[type="checkbox"]:not(:checked) + label:before,
[type="checkbox"]:checked + label:before,
[type="radio"]:not(:checked) + label:before,
[type="radio"]:checked + label:before {
  content: '';
  position: absolute;
  left: 0;
  top: 2px;
  width: 17px;
  height: 17px;
  border: 0px solid #aaa;
  background: #f0f0f0;
  border-radius: 3px;
  box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3);
}
/* checked mark aspect */
[type="checkbox"]:not(:checked) + label:after,
[type="checkbox"]:checked + label:after,
[type="radio"]:not(:checked) + label:after,
[type="radio"]:checked + label:after {
  position: absolute;
  color: #555555;
  transition: all .2s;
}
/* checked mark aspect changes */
[type="checkbox"]:not(:checked) + label:after,
[type="radio"]:not(:checked) + label:after {
  opacity: 0;
  transform: scale(0);
}
[type="checkbox"]:checked + label:after,
[type="radio"]:checked + label:after {
  opacity: 1;
  transform: scale(1);
}
/* disabled checkbox */
[type="checkbox"]:disabled:not(:checked) + label:before,
[type="checkbox"]:disabled:checked + label:before,
[type="radio"]:disabled:not(:checked) + label:before,
[type="radio"]:disabled:checked + label:before {
  box-shadow: none;
  border-color: #8c8c8c;
  background-color: #878787;
}
[type="checkbox"]:disabled:checked + label:after,
[type="radio"]:disabled:checked + label:after {
  color: #555555;
}
[type="checkbox"]:disabled + label,
[type="radio"]:disabled + label {
  color: #8c8c8c;
}
/* accessibility */
[type="checkbox"]:checked:focus + label:before,
[type="checkbox"]:not(:checked):focus + label:before,
[type="checkbox"]:checked:focus + label:before,
[type="checkbox"]:not(:checked):focus + label:before {
  border: 1px dotted #f6f6f6;
}
/* hover style just for information */
label:hover:before {
  border: 1px solid #f6f6f6 !important;
}
/*=== Customization ===*/
/* radio aspect */
[type="checkbox"]:not(:checked) + label:before,
[type="checkbox"]:checked + label:before {
  border-radius: 3px;
}
[type="radio"]:not(:checked) + label:before,
[type="radio"]:checked + label:before {
  border-radius: 35px;
}
/* selected mark aspect */
[type="checkbox"]:not(:checked) + label:after,
[type="checkbox"]:checked + label:after {
  content: '✔';
  top: 0;
  left: 2px;
  font-size: 14px;
}
[type="radio"]:not(:checked) + label:after,
[type="radio"]:checked + label:after {
  content: '\2022';
  top: 0;
  left: 3px;
  font-size: 30px;
  line-height: 25px;
}
/*=== 9. Misc ===*/
.logo {
  padding: 15px 0;
  font-size: 25px;
  color: #aaaaaa;
  font-weight: bold;
}
</style>
<div class="text-center" style="padding:50px 0">
	<div class="logo">login</div>
	<!-- Main Form -->
	<div class="login-form-1">
    	{{ Form::open(['url'=>url('login'), 'role'=>'form','method'=>'post','class'=>'form-horizontal']) }}
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="lg_username" class="sr-only">Username</label>
						<input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="username">
					</div>
					<div class="form-group">
						<label for="lg_password" class="sr-only">Password</label>
						<input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
					</div>
				</div>
				<button type="submit" class="login-button">Next</button>
			</div>
		{{ Form::close() }}
	</div>
	<!-- end:Main Form -->
</div>
@endif