<?php $this->load->view('/themes/public/header') ?>

<?php if($this->user): ?>
  <p>You are currently logged in. <a href="/admin">Show detail about my user</a></p>
<?php else: ?>
  <p>You are not logged in. <a href="/login">Login</a></p>
<?php endif ?>

<h4 class="page-header">Thanks to</h4>
<ul>
  <li>First of all the codeigniter community</li>
  <li>Phil Sturgeon for <a href="https://philsturgeon.uk/blog/2010/02/CodeIgniter-Base-Classes-Keeping-it-DRY/">Bases classes</a> method</li>
  <li>Jamie Rumbelow for <a href="http://github.com/jamierumbelow/codeigniter-base-model">CI base model</a></li>
  <li>Jens Segers for <a href="https://github.com/jenssegers/codeigniter-message-library">CI messages library</a></li>
  <li>Jakub Vrána for <a href="http://www.adminer.org/">Adminer</a></li>
</ul>

<h4 class="page-header">Permissions</h4>
<p>To manage permissions simply set in "roles.permissions" a json array with the uri allowed for that role.<br/>In permissions you can use the normal codeigniter routing rules: regex and ":any" or ":num" placehodlder.</p>
<pre>[
  "admin/specific/page", // view this page 
  "admin/users/:num/edit", // edit user
  "admin/cron/:any/check", // run cron for usual check
  "admin/.*", // view all admin page
  ".*" // become a ninja
]</pre>
<p>When you want to check rights, simply check if this method return TRUE</p>
<pre>$this->user_model->has_permission_by_uri()</pre>

<h4 class="page-header">CI base classes</h4>
<p>Normally I use base classes to manage my application. In the /application/core directory i have MY_Controller that extend CI_Controller.<br/>
In MY_Controller i do the things that needed to always doing (check user, autoload ecc...).<br/>
After this i create a base controllers that extend MY_Controller</p>
<pre>/application/core/Public_Controller.php // for frontend
/application/core/Admin_Controller.php // for backend</pre>
<p>In my normal workflow I extend the appropriate base controller from the controller in /application/controllers dir<br/>
For more detail about this, simply look in /application/core the MY_Controller.php and the Public and Admin Controller in the same dir.</p>

<h4 class="page-header">File manager</h4>
<p>You can manage files simply by upload and manage them via file_id. When you have a file uploaded via post, if you save them using this method</p>
<pre>$this->file_model->do_upload($name = 'file', $allowed_types = 'gif|jpg|png', $max_size = 2048);</pre>
<p>You have a file saved in</p>
<pre>$this->file_model->upload_dir.date('/Y/m/d/').$filename;</pre>
<p>The name of the file is automatically cleaned, and a file_id, or an array with two or more file_id, are returned from the method. You can use "multiple" html5 attribute on input file to upload multiple files at once</p>
<p>Config is hardly coded in</p>
<pre>/application/model/crud/File_model.php</pre>
<p>If you want you can move config paramenter to config dir</p>

<h4 class="page-header">Autoload</h4>
<p>I' ve two way to autoload resources, the simplest way is to add the resources that need to be loaded in MY_controller.</p>
<p>Moreover I autoload all classes in /application/core, to doing this I put this code in config/config.php</p>
<pre>/*
| -------------------------------------------------------------------
|  Native php Auto-load
| -------------------------------------------------------------------
| 
| Nothing to do with config/autoload.php, this allows PHP autoload to work
| for base controllers and some third-party libraries.
|
*/

function __autoload($class)
{
  $paths = array('core/');
  foreach($paths as $k => $v)
  {
    if(file_exists(APPPATH.$v.$class.'.php')) { include_once( APPPATH.$v.$class.'.php' ); }
  }
}</pre>

<h4 class="page-header">Database schema <small>sqlite</small></h4>
<pre>-- Adminer 4.1.0 SQLite 3 dump

DROP TABLE IF EXISTS "files";
CREATE TABLE "files" (
  "file_id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "size" text NOT NULL,
  "name" text NOT NULL,
  "path" text NOT NULL,
  "type" text NOT NULL,
  "created_at" text NOT NULL,
  "created_by" integer NULL
);


DROP TABLE IF EXISTS "roles";
CREATE TABLE "roles" (
  "role_id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "name" text NOT NULL,
  "permissions" text NOT NULL
);

INSERT INTO "roles" ("role_id", "name", "permissions") VALUES (1, 'admin',  '["admin/specific/page","admin/users/:num/edit","admin/cron/:any/check","admin/.*",".*"]');

DROP TABLE IF EXISTS "sessions";
CREATE TABLE "sessions" (
  "id" text NOT NULL,
  "ip_address" text NOT NULL,
  "timestamp" integer NOT NULL,
  "data" text NOT NULL
);


DROP TABLE IF EXISTS "users";
CREATE TABLE "users" (
  "user_id" integer NOT NULL PRIMARY KEY AUTOINCREMENT,
  "username" text NOT NULL,
  "email" text NOT NULL,
  "password" text NOT NULL,
  "name" text NOT NULL,
  "surname" text NOT NULL,
  "status" integer(1) NOT NULL,
  "logged_at" text NOT NULL,
  "created_at" text NOT NULL,
  "updated_at" text NOT NULL,
  "token" text NOT NULL
);

INSERT INTO "users" ("user_id", "username", "email", "password", "name", "surname", "status", "logged_at", "created_at", "updated_at", "token") VALUES (1,  'admin',  'admin@example.com',  '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 'admin',  'istrator', 1,  '2015-06-17 09:50:26',  '2015-06-15 09:00:41',  '2015-06-17 09:50:26',  '');

DROP TABLE IF EXISTS "users_x_roles";
CREATE TABLE "users_x_roles" (
  "user_id" integer NOT NULL,
  "role_id" integer NOT NULL,
  FOREIGN KEY ("user_id") REFERENCES "users" ("user_id") ON DELETE RESTRICT ON UPDATE RESTRICT,
  FOREIGN KEY ("role_id") REFERENCES "roles" ("role_id") ON DELETE RESTRICT ON UPDATE RESTRICT
);

INSERT INTO "users_x_roles" ("user_id", "role_id") VALUES (1, 1);

--</pre>

<?php $this->load->view('/themes/public/footer') ?>