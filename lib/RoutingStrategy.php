<?php
	interface RoutingStrategy {
		public function buildUrl($params);
		
		public function getParam($paramName);
	}