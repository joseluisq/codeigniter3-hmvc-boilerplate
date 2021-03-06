<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Welcome to User Module</title>

    <style type="text/css">


      ::selection { background-color: #DD4814; color: white; }
      ::-moz-selection { background-color: #DD4814; color: white; }

      body {
        background-color: #fff;
        margin: 40px;
        font: 13px/20px normal Helvetica, Arial, sans-serif;
        color: #4F5155;
      }

      a {
        color: #DD4814;
        background-color: transparent;
        font-weight: normal;
        text-decoration: none;
        border-bottom: dotted 1px #DD4814;
      }

      h1 {
        color: #DD4814;
        background-color: transparent;
        border-bottom: 1px solid #D0D0D0;
        font-size: 1.8em;
        font-weight: normal;
        margin: 0;
        padding: 1em;
      }

      pre,
      code {
        font-family: Consolas, Monaco, Courier New, Courier, monospace;
        font-size: 12px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        color: #333;
        display: block;
        margin: 14px 0 14px 0;
        padding: 12px 10px 12px 10px;
        line-height: 1.5;
      }

      #body {
        margin: 2em;
      }

      p.footer {
        text-align: right;
        font-size: 11px;
        border-top: 1px solid #D0D0D0;
        padding: 5px 10px 5px 10px;
        margin: 20px 0 0 0;
      }

      #container {
        margin: 10px;
        border: 1px solid #D0D0D0;
        box-shadow: 0 0 8px #D0D0D0;
      }
    </style>
  </head>
  <body>

    <div id="container">

      <h1>User Module</h1>


      <div id="body">
        <h3>Module directory:</h3>

        <pre>
application/modules
│
└── user
    ├── config
    │   └── routes.php
    ├── controllers
    │   └── User_controller.php
    ├── models
    │   └── User_model.php
    └── views
        └── User_message.php
</pre>
        
        <h3>User Model</h3>
        
        <pre>
// User_controller.php  
$this->User_model->find_all();
</pre>
        <strong>Records from database:</strong>
        
        <ol>
        {users}
        <li>{UserFullname} (<a href="#">{UserEmail}</a>)</li>
        {/users}
        </ol>
      </div>

      <p class="footer">
        Page rendered in <strong>{elapsed_time}</strong> seconds. 
        <?php echo (ENVIRONMENT === 'development') ? 'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?>
      </p>
    </div>

  </body>
</html>