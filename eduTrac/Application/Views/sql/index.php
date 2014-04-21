<?php if ( ! defined('BASE_PATH') ) exit('No direct script access allowed');
/**
 *
 * SQL Terminal View
 *  
 * PHP 5.4+
 *
 * eduTrac(tm) : Student Information System (http://www.7mediaws.org/)
 * @copyright (c) 2013 7 Media Web Solutions, LLC
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 * 
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3
 * @link        http://www.7mediaws.org/
 * @since       3.0.0
 * @package     eduTrac
 * @author      Joshua Parker <josh@7mediaws.org>
 */

use \eduTrac\Classes\Core\DB;
$log = new \eduTrac\Classes\Libraries\Log;
$auth = new \eduTrac\Classes\Libraries\Cookies;
$uname = $auth->getPersonField('uname');

$type = isPostSet('type');
$qtext = isPostSet('qtext');
$qtext = str_replace("\\","",$qtext);
?>

<ul class="breadcrumb">
	<li><?=_t( 'You are here' );?></li>
	<li><a href="<?=BASE_URL;?>dashboard/<?=bm();?>" class="glyphicons dashboard"><i></i> <?=_t( 'Dashboard' );?></a></li>
	<li class="divider"></li>
	<li><?=_t( 'SQL Interface' );?></li>
</ul>

<h3><?=_t( 'SQL Interface' );?></h3>
<div class="innerLR">
	
	<!-- Form -->
	<form class="form-horizontal margin-none" action="<?=BASE_URL;?>sql/" id="validateSubmitForm" method="post">
		
		<!-- Widget -->
		<div class="widget widget-heading-simple widget-body-gray">
		
			<!-- Widget heading -->
			<div class="widget-head">
				<h4 class="heading"><font color="red">*</font> <?=_t( 'Indicates field is required' );?></h4>
			</div>
			<!-- // Widget heading END -->
			
			<div class="widget-body">
			
				<!-- Row -->
				<div class="row">
					
					<!-- Column -->
					<div class="col-md-6">
					
						<!-- Group -->
						<div class="form-group">
							<label class="col-md-3 control-label" for="term"><font color="red">*</font> <?=_t( 'Query' );?></label>
							<div class="col-md-8">
								<textarea id="mustHaveId" class="form-control" rows="5" style="width:65em;" name="qtext" required><?php if(isset($qtext)) { echo $qtext; } ?></textarea>
							</div>
						</div>
						<!-- // Group END -->
						
					</div>
					<!-- // Column END -->
					
				</div>
				<!-- // Row END -->
			
				<hr class="separator" />
				
				<!-- Form actions -->
				<div class="form-actions">
					<input type="hidden" name="type" value="query" >
					<button type="submit" name="submit" class="btn btn-icon btn-primary glyphicons circle_ok"><i></i><?=_t( 'Submit' );?></button>
				</div>
				<!-- // Form actions END -->
				
			</div>
		</div>
		<!-- // Widget END -->
		
	</form>
	<!-- // Form END -->
	
	<?php if(isset($type)) { ?>
	<!-- Widget -->
	<div class="widget widget-heading-simple widget-body-gray">
		<div class="widget-body">
		
			<!-- Table -->
			<?php
                if (strstra(strtolower($_POST['qtext']), forbidden_keyword())) {
                    redirect( BASE_URL . 'error/sql/' );
                    exit();
                }
                
				if($type == "query") {
				
					$qtext2 = str_replace("\\", " ", $qtext);
                    /* Write to activity log table. */
                    $log->setLog("Query", "SQL Interface", $qtext2, $uname );
				
						if($result = DB::inst()->query("$qtext2"))
							_e( _t( "Successly Executed - " ) );
						else
							echo "<font color=red>Not able to execute the query<br>Either the 
								table does not exist or the query is malformed.</font><br><br>";
				
						_e( _t( "Query is : " ) );
						echo("<font color=blue>"._h($qtext2)."</font>\n");
						
						echo "<table class=\"dynamicTable tableTools table table-striped table-bordered table-condensed table-white\">
						<thead>
						<tr>\n";
						
						foreach(range(0, $result->columnCount() - 1) as $column_index)
						{
						$meta[] = $result->getColumnMeta($column_index);
						echo "<th>".$meta[$column_index]['name']."</th>";
						}
						echo "</tr>\n</thead>\n";
				
						$vv = true;
						while ($row = $result->fetch(\PDO::FETCH_NUM)) {
							if($vv === true) {
					   		echo "<tr>\n";
							$vv = false;
							}
							else{
						   	echo "<tr>\n";
							$vv = true;
							}
						  	foreach ($row as $col_value) {
				       		echo "<td>"._h($col_value)."</td>\n";
				   			}
					   	echo "</tr>\n";
						}
						echo "</table>\n";
						/* Free resultset */
						$result->closeCursor();
					}
			
			?>
			<!-- Table End -->
			
		</div>
	</div>
	<?php } ?>
	<div class="separator bottom"></div>
	<!-- // Widget END -->
	
</div>	
	
		
		</div>
		<!-- // Content END -->