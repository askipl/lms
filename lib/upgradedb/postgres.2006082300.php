<?php

/*
 * LMS version 1.11-cvs
 *
 *  (C) Copyright 2001-2007 LMS Developers
 *
 *  Please, see the doc/AUTHORS for more information about authors!
 *
 *  This program is free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License Version 2 as
 *  published by the Free Software Foundation.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program; if not, write to the Free Software
 *  Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307,
 *  USA.
 *
 *  $Id$
 */

$DB->BeginTrans();

$DB->Execute("ALTER TABLE assignments ADD COLUMN nodeid integer");
$DB->Execute("UPDATE assignments SET nodeid = 0");
$DB->Execute("ALTER TABLE assignments ALTER COLUMN nodeid SET NOT NULL");
$DB->Execute("ALTER TABLE assignments ALTER COLUMN nodeid SET DEFAULT 0");

$DB->Execute("CREATE INDEX assignments_nodeid_idx ON assignments (nodeid)");
$DB->Execute("CREATE INDEX assignments_customerid_idx ON assignments (customerid)");

$DB->Execute("UPDATE dbinfo SET keyvalue = ? WHERE keytype = ?",array('2006082300', 'dbversion'));

$DB->CommitTrans();

?>