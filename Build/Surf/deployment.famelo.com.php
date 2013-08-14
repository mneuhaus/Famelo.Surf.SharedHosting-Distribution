<?php
use \TYPO3\Surf\Domain\Model\Workflow;
use \TYPO3\Surf\Domain\Model\Node;
use \TYPO3\Surf\Domain\Model\SimpleWorkflow;


$application = new \Famelo\Surf\SharedHosting\Application\Flow('deployment.famelo.com');
$application->setDeploymentPath('/kunden/350350_33330/deployment');
$application->setOption('repositoryUrl', 'git@github.com:mneuhaus/Famelo.Surf.SharedHosting-Distribution.git');

$node = new Node('deployment.famelo.com');
$node->setHostname('famelo.com');
$node->setOption('username', 'ssh-350350-famelo');
$application->addNode($node);

// Specify the hosting package
$application->setHosting('DomainFactory/ManagedHosting');

// Set the default context
// $application->setContext('Production');
// $application->setOption('keepReleases', 1);

$workflow = new SimpleWorkflow();
// Enable to keep "broken" deployment for aftermath analysis
$workflow->setEnableRollback(FALSE);


// Download Beard and patch based on beard.json or gerrit.json
// $workflow->afterTask('typo3.surf:composer:install', array(
// 	'famelo.surf.sharedhosting:downloadBeard',
// 	'famelo.surf.sharedhosting:beardPatch'
// ));

$deployment->setWorkflow($workflow);
$deployment->addApplication($application);
?>