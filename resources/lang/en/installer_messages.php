<?php


return [

    /*
     *
     * Shared translations.
     *
     */
    'title' => 'WOKOYA Installer',
    'next' => 'Next Step',
    'back' => 'Previous',
    'finish' => 'Install',
    'forms' => [
        'errorTitle' => 'The Following errors occurred:',
    ],
    /**
     * 
     * Init
     */
    "init" => [
        'next_title' => "Check .env file for installation",
        'next_status' => "Check <code>.env</code> file for installation",
    ],

    /*
     *
     * Welcome
     *
     */
    'welcome' => [
        'status' => 'Welcome to Wokoya CMS',
        'templateTitle' => '',
        'title' => 'Welcome to Wokoya CMS',
        'description' => '<div><a href="">Wokoya</a> is cms based with Laravel. Related with <a href="https://codecanyon.net/licenses/standard">codecanyon standard licenses</a>.</div>'.
                        '<div>If you have any questions that are beyond the scope of this'.
                        ' cms, feel free to email at <a href="mailto:ducorteam@gmail.com">ducorteam@gmail.com</a>'.
                        '</div><br/>'.
                        ' <ul>'.
                        '   <li>'.
                        '     <strong>By:</strong>'.
                        '     <a href="https://codecanyon.net/user/ducor">Ducor Team</a>'.
                        '   </li>'.
                        '   <li>'.
                        '     <strong>Platform:</strong>'.
                        '     Laravel Framework'.
                        '   </li>'.
                        '   <li>'.
                        '     <strong>Email:</strong>'.
                        '     <a href="mailto:ducorteam@gmail.com">ducorteam@gmail.com</a>'.
                        '   </li>'.
                        ' </ul>'.
                        '',
        'next'    => 'Start',
    ],

    /*
     *
     * Requirements page translations.
     *
     */
    'requirements' => [
        'templateTitle' => 'Server Requirements',
        'title' => 'Server Requirements',
        'next'    => 'Next',
        'current' => 'Check Again'
    ],

    /*
     *
     * Permissions page translations.
     *
     */
    'permissions' => [
        'templateTitle' => 'Permissions',
        'title' => 'Permissions',
        'next' => 'Next',
        'current' => 'Check Again'
    ],
    /*
     *
     * database page translations.
     *
     */
    'database' => [
        'templateTitle' => 'Please prepare an empty database for this installation.',
        'title' => 'Database Connection',
        'form' => [
            'db_connection_failed' => 'Could not connect to the database.',
            'db_connection_label' => 'Database Connection',
            'db_connection_info' => 'Please specify the database driver type for this connection.',
            'db_connection_label_mysql' => 'mysql',
            'db_connection_label_pgsql' => 'pgsql',
            'db_connection_label_sqlite' => 'sqlite',
            'db_host_label' => 'Database Host',
            'db_host_info' => 'Specify the hostname for the database connection.',
            'db_host_placeholder' => 'Database Host',
            'db_port_label' => 'Database Port',
            'db_port_info' => '(Optional) Specify a non-default port for the database connection.',
            'db_port_placeholder' => 'Database Port',
            'db_name_label' => 'Database Name',
            'db_name_info' => 'Specify the name of the empty database.',
            'db_name_placeholder' => 'Database Name',
            'db_username_label' => 'Database User Name',
            'db_username_info' => 'User with all privileges in the database.',
            'db_username_placeholder' => 'Database. Username',
            'db_password_label' => 'Database Password',
            'db_password_info' => 'Password for the specified user.',
            'db_password_placeholder' => 'Database Password',
        ],
        'error' => [
            'connection' => "<strong>Database Connection Fails!</strong> Check you database information.",
            'table_not_empty' => "Database [:name] not empty! Please remove all of table manually"
        ],
        'next' => "Save",
        'success' => 'Your .env file settings have been saved.',
        'errors' => 'Unable to save the .env file, Please create it manually.',
    ],

    /*
     *
     * Migration and seed.
     *
     */
    'migration' => [
        'title'   => 'WOKOYA Migration & Seeding ',
        'message' => 'WOKOYA -> Migration & Seeding ',
        'body' => 'All right! You’ve made it through this part of the installation. This App can now communicate with your database. If you are ready, time now to…',
        'next'    => "Migrate and Seed",
    ],

    /*
     *
     * admin page translations.
     *
     */
    'admin' => [
        'templateTitle' => 'Information needed',
        'body' => 'Please provide the following information. Don’t worry, you can always change these settings later.',
        'title' => 'Admin Setup',
        'next' => 'Save',

        'form' => [
            'app_name_label' => 'App Name',
            'admin_name_label' => 'Username',
            'admin_email_label' => 'Email',
            'admin_password_label' => 'Password',

            'admin_name_info' => 'Fullname can have only alphanumeric characters, spaces, underscores, hyphens, periods.',
            'admin_email_info' => 'Double-check your email address before continuing.',
            'admin_password_info' => ' <strong>Important:</strong> You will need this password to log in. Please store it in a secure location.',
        ],

        "error" => [
            'create_user_account' => "You can not avoid it."
        ]

    ],

    'install' => 'Install',

    /*
     *
     * Installed Log translations.
     *
     */
    'installed' => [
        'success_log_message' => 'Application Installer successfully INSTALLED on ',
    ],

    /*
     *
     * Final page translations.
     *
     */
    'final' => [
        'title' => 'Installation Finished',
        'status' => 'Success!',
        'templateTitle' => 'Application has been successfully installed.',
        'finished' => 'Application has been successfully installed.',
        'migration' => 'Migration &amp; Seed Console Output:',
        'console' => 'Application Console Output:',
        'log' => 'Installation Log Entry:',
        'chosen_password' => 'Your chosen password',
        'next' => 'Login',
    ],

    /*
     *
     * Error page translations.
     *
     */
    "error" => [
        'title' => 'Installation Error',
        'status' => 'Whoops!',
        'templateTitle' => 'There was something wrong during the installation!',
        'description' => "Please check your log located inside <code>storage/logs</code> directory to see what's going on.",
        'next' => ' Try Again',
    ]
];
