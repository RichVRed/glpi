<?php
/*
 * @version $Id: typedoc.form.php 8624 2009-08-04 12:45:43Z moyo $
 -------------------------------------------------------------------------
 GLPI - Gestionnaire Libre de Parc Informatique
 Copyright (C) 2003-2009 by the INDEPNET Development Team.

 http://indepnet.net/   http://glpi-project.org
 -------------------------------------------------------------------------

 LICENSE

 This file is part of GLPI.

 GLPI is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 GLPI is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with GLPI; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 --------------------------------------------------------------------------
 */

// ----------------------------------------------------------------------
// Original Author of file: Remi Collet
// Purpose of file:
// ----------------------------------------------------------------------


$NEEDED_ITEMS=array('tracking');

define('GLPI_ROOT', '..');
include (GLPI_ROOT . "/inc/includes.php");


if(!isset($_GET["id"])) {
   $_GET["id"] = "";
}
$category = new TicketCategory();

if (isset($_POST["add"])) {
   $category->check(-1,'w');

   if ($newID=$category->add($_POST)) {
      logEvent($newID, "ticketcategory", 4, "setup",
               $_SESSION["glpiname"]." added ".$_POST["name"].".");
   }
   glpi_header($_SERVER['HTTP_REFERER']);

} else if (isset($_POST["delete"])) {
   $category->check($_POST["id"],'w');
   $category->delete($_POST,1);

   logEvent($_POST["id"], "ticketcategory", 4, "setup", $_SESSION["glpiname"]." ".$LANG['log'][22]);
   glpi_header($CFG_GLPI["root_doc"]."/front/ticketcategory.php");

} else if (isset($_POST["update"])) {
   $category->check($_POST["id"],'w');
   $category->update($_POST);

   logEvent($_POST["id"], "ticketcategory", 4, "setup", $_SESSION["glpiname"]." ".$LANG['log'][21]);
   glpi_header($_SERVER['HTTP_REFERER']);

} else {
   commonHeader($LANG['common'][12],$_SERVER['PHP_SELF'],"config","ticketcategory");
   $category->showForm($_SERVER['PHP_SELF'],$_GET["id"]);
   commonFooter();
}

?>
