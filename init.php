<?php defined( 'SYSPATH' ) or die( 'No direct script access.' );

Plugin::factory('stats', array(
	'title' => 'Stats',
	'description' => 'Построение графиков и отчетов (Без использования сервисов Yandex, Google ... .).',
	'version' => '1.0.1',
))->register();