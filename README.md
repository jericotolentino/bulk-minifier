Introduction
===

Bulk minifier is a JavaScript minifier script for use with client-side scripts so that minification can be automated (or sped up) during a build. Uses Google's Closure Compiler for minifying files.

Requirements
--
* LibYAML
* PECL
* Java Runtime Environment
* Google Closure compiler (bundled)

Installation
--
```sh
git clone [repo-url] minifier
cd minifier
php minify.php my-project
```

Customization of the YAML file
--
By default, the bundled YAML file (my-project.yaml) compresses a very simple JavaScript file. This section shows how to customize it for multiple files and different directories.
```yaml
app: My Awesome Project
path: .

files:
    - input: /javascript.js
      output: /javascript.min.js
```

The first thing you'll probably want to modify is the application name (app):

```yaml
app: (Change this to the human-readable name of your application)
```

If you have the minify.php file at the root of your application, you can just keep the path set to a period(.). But if you are working on multiple projects and prefer to have a central location for the minifier, you can specify the full path (no trailing space).

```yaml
path: /path/to/my/awesome/project
```

Next are the files you'll be minifying. To do so, just make entries under the files section, using an additional dash for each file. For each file, you'll need to specify an input and output file. Careful with indention!

```yaml
files:
    - input: /js/javascript.js
      output: /js/javascript.min.js
    - input: /css/stylesheet.css
      output: /css/stylesheet.min.css
```

Once you're done, just save it using a filename without spaces and with a .yaml extension (e.g., my-project.yaml).

To start minifying, just run the following command (third parameter is your file without the .yaml extension):

```sh
php minify.php my-project
```

You should get something like this:

```sh
Starting compression for My Awesome Project
=================================
Compressing files:
Compressed ./javascript.js to 77 bytes
```

Use in multiple projects
--
For multiple projects, you can have a central location for the bulk minifier (e.g., /home/jerico/Scripts/minifier). From that location, just create a YAML file for each project, then run the minifier, passing the name of each file (without the .yaml extension), separated by spaces:

```sh
php minify.php my-project-1 my-project-2 my-project-3
```
