<?php
/* @file - Script fires after composer install/update
  Unclear why includes are needed, but namespace is not working 
 (Mapper class not found in DefinitiveDrupal\Tangler namespace)
*/

namespace Definitivedrupal\Tangler;

// Why are these includes needed?!!
include 'Application.php';
include 'Mapper.php';
include 'Command.php';

use Composer\Script\Event;

class ScriptHandler
{
    public static function postUpdate(Event $event)
    {
        $composer = $event->getComposer();
                $app = new Application();

        $mapper = new Mapper(getcwd(), getcwd().'/www');
        $mapper->mirror($mapper->getMap(
            $composer->getInstallationManager(),
            $composer->getRepositoryManager()
        ));
    }
}
