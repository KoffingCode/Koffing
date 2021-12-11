<?php

use Routes\WaitersApi;
use Routes\TablesApi;
use Routes\QuerysWaiterApi;
use Routes\TurnosApi;

include 'WaitersApi.php';
include 'TablesApi.php';
include 'QuerysWaiterApi.php';
include 'TurnosApi.php';

TablesApi::routesTable();
QuerysWaiterApi::routesQuerysWaiter();
WaitersApi::routesWaiter();
TurnosApi::routesTurn();
