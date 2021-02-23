<?php

namespace Robolo\ConventionsPhp;

use GrumPHP\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * Grumphp extension that allows to:
 *
 * 1: define extra tasks
 * 2: skip tasks
 * 3: Update testsuites if needed
 */
class GrumphpTasksExtension implements ExtensionInterface
{
  /**
  * {@inheritdoc}
  */
  public function load(ContainerBuilder $container): void
  {
    if ($container->hasParameter('extra_tasks')) {
      $tasks = $container->getParameter('tasks');
      foreach ($container->getParameter('extra_tasks') as $name => $value) {
        if (array_key_exists($name, $tasks)) {
          throw new RuntimeException("Cannot override already defined task '{$name}' in 'extra_tasks'.");
        }
        $tasks[$name] = $value;
      }
      $container->setParameter('tasks', $tasks);
    }

    if ($container->hasParameter('skip_tasks')) {
      $tasks = $container->getParameter('tasks');

      foreach ($container->getParameter('skip_tasks') as $name) {
        unset($tasks[$name]);
      }

      $container->setParameter('tasks', $tasks);
    }
  }
}
