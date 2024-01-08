<div class="" style="margin:0px;"  ng-controller="SummaryCtrl"  ng-init="">
	
		<?php   //{{searchRecords}}
		echo "{{}}<ng-form name='frmM' class='form-group form-line'><div class='row' style='margin-left:1%; margin-top:-30px;'>"; funcRecord(); echo "</div></ng-form>";
		echo"<div id='display' class='row' style='margin-top:10px; margin-left:10px;'></div>";
	echo "<ng-form name='frmP' class='form-group form-line' ng-show='showNav'>";  echo "</ng-form>";		
function funcRecord() { echo"<div class=row style='margin-top:0px;'>"; 
		echo "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3' style='margin-left: 10px;'><label>Choose Task: </label><select style='border-radius: 5px; background-color:;' class='dropdown-toggle form-control' data-toggle='dropdown' type='text' id='ReportList' ng-change='onSelectionReports()'  ng-model='selected' ng-options='T as T.Task for T in Tasks track by T.Task'></select></div> ";
		echo"<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'>"; ?> 
			<label>Search Keyword: </label><input type="text"  id="searchMain" class="form-control" name="searchMain" ng-model="searchReport" placeholder="search record!" ng-pattern="" autocomplete=off uib-typeahead="aL  for aL in searchList() | filter: $viewValue | limitTo:8" typeahead-wait-ms=10 typeahead-on-select="typeaheadOnSelectsearch($item, $index)"> 
	<?php 				 
		echo"</div><div class='col-xs-2 col-sm-2 col-md-2 col-lg-2 style=''><label>&nbsp;</label><br><button type='submit' id='printBtn' class='btn btn-primary form-control' ng-click='' name='openWindow' value=''>Print Preview</button></div><div class='col-xs-2 col-sm-2 col-md-2 col-lg-2' id=ctrlMed></div></div>"; 	
}
		?>	
</div>

