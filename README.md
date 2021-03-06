# Drupal Tangler

This library provides tools for an opinionated composer workflow with Drupal.

When invoked, it creates a Drupal root that can respond to requests routed to
it from a web server.

The algorithm is something like this:

1. copy drupal/drupal out of vendor and into the given drupal path (default: www)
2. link modules and themes installed with composer from vendor into the drupal
   root
3. link directories from the modules directory into sites/all/modules
4. link directories from the themes directory into sites/all/themes
5. link files that look like module files into a directory in sites/all/modules
6. link cnf/settings.php into sites/default
7. link vendor into sites/default
8. link cnf/files into sites/default

This version is updated to optionally allow all drupal modules & themes (steps 2-5) to be copied, instead of linked, so that the resultant installation can be used with Pantheon. 

We also ignore .git as a filepath so as to not clobber the git history in our Pantheon subtree (with Drupal core's .git history.) This version also ignores .gitignore though that seems like a mistake. 

Also, should probably indicate a minimum version of PHP since this will not likely work unless you have >=5.4.0

# Installation

Use composer.

# Usage

You have the choice of using a small commandline application or a script
handler.

## Commandline

```
vendor/bin/drupal_tangle -h
Usage:
 drupal:tangle [project] [drupal]

Arguments:
 project               path to project to tangle
 drupal                path to drupal in which to tangle (default: "www")
```

## Composer Script Configuration

You can automate the use of the tangler in response to composer events like so:

```
{
...
    "scripts": {
        "post-install-cmd": [
          "DefinitiveDrupal\\Tangler\\ScriptHandler::postUpdate",
        ],
        "post-update-cmd": [
          "DefinitiveDrupal\\Tangler\\ScriptHandler::postUpdate"
        ]
    },
...
}
```
