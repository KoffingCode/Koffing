<?php

use Routes\WaitersApi;
use Routes\TablesApi;
use Routes\QuerysWaiterApi;
use Routes\TurnosApi;
use Routes\UsersApi;

include 'WaitersApi.php';
include 'TablesApi.php';
include 'QuerysWaiterApi.php';
include 'TurnosApi.php';
include 'UsersApi.php';

TablesApi::routesTable();
QuerysWaiterApi::routesQuerysWaiter();
WaitersApi::routesWaiter();
TurnosApi::routesTurn();
UsersApi::routesUser();