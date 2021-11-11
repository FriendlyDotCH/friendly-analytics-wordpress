<?php

namespace Friendly\Analytics;

final class PluginFactory
{

    // Create and return instance of Plugin if it passes all checks
    public static function create()
    {
		static $plugin = null;

		if ($plugin === null) {
			$plugin = new Plugin();
		}

		return $plugin;
    }
}
