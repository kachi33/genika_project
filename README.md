<h1> to get the project up and runing</h1>
<ul>
    <li>Install xampp on your system</li>
    <li>install composer on your system</li>
    <li>install gitbash on your system</li>
    <li>clone the repository by copying the command below and running it on your command line</li>
    <pre>
        <code>git clone https://github.com/okoye-peter/genika_project.git</code>
    </pre>
    <li>cd into the project and run the command to install all needed package</li>
    <pre>
        <code>composer install</code>
    </pre>
    <pre>
        <code>npm install && npm run dev</code>
    </pre>
    <li>create your database</li>
    <li>duplicate .env.example and rename the duplicate to .env</li>
    <li>add you database credentials to .env file</li>
    <li>run the command to generate application key</li>
    <pre>
        <code>php artisan key:gen</code>
    </pre>
    <li>run the command to migrate your table</li>
    <pre>
        <code>php artisan migrate</code>
    </pre>
    <li>run the command to start the server</li>
    <pre>
        <code>php artisan serve</code>
    </pre>
</ul>