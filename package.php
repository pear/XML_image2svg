<?php
/**
 * Script to generate package.xml file
 *
 * Taken from PEAR::Log, thanks Jon ;)
 */
require_once 'PEAR/PackageFileManager.php';
require_once 'Console/Getopt.php';

$version = '1.0';

$notes = <<<EOT
* fixed integration of HTML_Template_IT
* various CS fixes
EOT;

$description = <<<EOT
The class converts images, such as of the format JPEG, PNG 
and GIF to a standalone SVG representation. The image is being encoded 
by the PHP native encode_base64() function. You can use it to get back 
a complete SVG file, which is based on a predefinded, easy adaptable 
template file, or you can take the encoded file as a return value, using 
the get() method. Due to the encoding by base64, the SVG files will 
increase approx. 30% in size compared to the conventional image.
EOT;

$package = new PEAR_PackageFileManager();

$result = $package->setOptions(array(
    'package'           => 'XML_image2svg',
    'summary'           => 'Image to SVG conversion',
    'description'       => $description,
    'version'           => $version,
    'state'             => 'stable',
    'license'           => 'PHP 2.02',
    'filelistgenerator' => 'cvs',
    'ignore'            => array('package.php', 'package.xml'),
    'notes'             => $notes,
    'changelogoldtonew' => true,
    'simpleoutput'      => true,
    'baseinstalldir'    => '/XML/image2svg/',
    'packagedirectory'  => './',
    'dir_roles'         => array('tests'              => 'test')
));

if (PEAR::isError($result)) {
    echo $result->getMessage();
    die();
}

$package->addMaintainer('urs',  'lead',        'Urs Gehrig',      'urs@circle.ch');

$package->addDependency('HTML_Template_IT',        false, 'has', 'pkg', true);

if (isset($_GET['make']) || (isset($_SERVER['argv'][2]) && $_SERVER['argv'][2] == 'make')) { 
    $result = $package->writePackageFile();
} else {
    $result = $package->debugPackageFile();
}

if (PEAR::isError($result)) {
    echo $result->getMessage();
    die();
}
