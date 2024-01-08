<link rel=stylesheet href='css/bootstrap-responsive.css' media=all type=text/css>
<link rel=stylesheet href='css/Bootstrap.min.css' media=all type=text/css>
<link rel='stylesheet' href='css/ui-bootstrap-2.5.0-csp.css' type='text/css'> 
<link rel='stylesheet' href='css/printable.css' type='text/css'>
			<div class="" style=""  ng-controller="RecordMgtCtrl"  ng-init="getMainTables2()">
		<?php 		 
		echo "{{}}<ng-form name='' class='form-group form-line'><div class='row-fluid table-responsive' style='margin-top:10px;'>"; //{{arrDataInfo[1]['EmpId'][0]}}{{Records}}{{staffCertSummary}}
			echo "<div class='col-xs-6 col-sm-6 col-md-6 col-lg-6' style='margin-left:20%;'><select style='border-radius: 5px;' class='dropdown-toggle form-control' data-toggle='dropdown' type='text' id='MainTableSelection2' ng-change='onSelectionChange2()'  ng-model='selected' ng-options='rec as rec.Task for rec in selectionRecords2 track by rec.Task'></select></div> ";				
		?>		
		<?php
		echo "</div></ng-form>"; 
	echo "<div class='row-fluid' style='margin-top:5px;'>";		
		echo "<ng-form name='frmM'><div ng-show='showNav' class='' style='margin:0px;'>"; funcRecord();  echo "</div></ng-form>";
		echo "<ng-form name='frmP'><div ng-show='showAssNav' class='' style='margin:0px;'>"; relRecords(); echo "</div></ng-form>";
	echo "</div>";	
function funcRecord() {  ?>		
		<?php 
			echo "<div class='row-fluid table-responsive' ng-show='showNav'  style='border: 1px solid; border-radius:7px;' >"; 	
			echo "<span style='float:left; margin-left:0px;'><button id='collapseM' style='border-radius:5px;' class=''  ng-click='collapseMain()'></button></span>";						
				echo "<div style='margin-left:30px;'>"; funcNavigation(); echo "</div>";
			echo "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 table table-responsive'   style='display:inline-block;'>";  ?>
				<div ng-repeat="f in C3" style="">			
					<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style=" margin:0px; float:right; height: 120px; border-radius: 4px; border: 1px solid gray; color: black;">
						<label for=f.tblId style='font-weight:normal;'> {{f.tblComments}} </label> 
						<textarea rows="3" class="form-control" style="resize:none;" spellcheck="true" placeholder="Type progress Note Here!" id="f.tblId" name="LabM_{{$index}}" ng-model="f.tblName"  ng-pattern="f.tblPat" ng-style="f.tblStyle" ng-disabled="f.assngEnaDis" autocomplete=off ng-change="inputChange(frmP['Label_' + $index].$error.pattern, $index)" ng-blur="inputBlur(f.tblName, $index)"></textarea> 			
						</div>
					</div>			
			<div ng-repeat="f in C1">
				<div ng-if="$index===1" id="summy"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="margin:0px; height: 115px; float:right; border-radius: 4px; border: 3px solid gray; "></div>
				<div ng-if="!f.tblNgIf" class="col-xs-3 col-sm-3 col-md-3 col-lg-3" ng-hide="b.tblAutoInc" style="margin:0px; float:left;  border-radius: 4px; border: 1px solid gray;">									
					<label for=f.tblId style="font-weight:normal;"> {{f.tblComments}}:</label>
					<div ng-class="{'has-error': frmM['LabM_' + $index].$invalid, 'has-success': !frmM['LabM_' + $index].$invalid}"> 
					<input type="{{f.tblInputType}}" id="f.tblId" class="form-control" ng-style="f.tblStyle" name="LabM_{{$index}}"  ng-pattern="f.tblPat" ng-disabled="f.ngEnaDis" ng-model="f.tblName" ng-checked="f.tblChecked" autocomplete=off  ng-change="inputChange(frmM['LabM_'+$index].$error.pattern, $index)" ng-blur="inputBlur(f.tblName, $index)">					
					<span class="error" ng-show="frmM['LabM_'+$index].$error.pattern" style="font-family: Times New Roman, Times, serif; color: red;">  Invalid input</span>		
					</div>
				</div>				
			<div ng-if="f.tblNgIf" class="col-xs-3 col-sm-3 col-md-3 col-lg-3 float:left;" ng-hide="f.tblAutoInc" style="border-radius: 4px; border: 1px solid gray;  background-color: ; color: black;">			
				<label for=f.tblId style="font-weight:normal;">{{f.tblComments}}: </label>
				<div ng-class="{'has-error': frmM['LabM_' + $index].$invalid, 'has-success': !frmM['LabM_' + $index].$invalid}"> 
				<input type="{{f.tblInputType}}" id="f.tblId" class="form-control" ng-style="f.tblStyle"  name="LabM_{{$index}}"  ng-pattern="f.tblPat" ng-disabled="f.ngEnaDis" ng-model="f.tblName" ng-checked="f.tblChecked" autocomplete=off  ng-change="inputChange(frmM['LabM_'+$index].$error.pattern, $index)" ng-blur="inputBlur(f.tblName, $index)" uib-typeahead="aList  for aList in autoList(f.tblLabel, selected.M_Table) | filter: $viewValue | limitTo:4" typeahead-wait-ms=10 typeahead-on-select='typeaheadOnSelect2(f.tblLabel, $item, $index)'>{{$item}}
				<span class="error" ng-show="frmM['LabM_'+$index].$error.pattern" style="font-family: Times New Roman, Times, serif; color: red;">  Invalid input</span>			
				</div>
			</div>
			</div>
			<div ng-repeat="f in C2">
				<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" ng-hide="f.tblAutoInc" style="float:right; border-radius: 4px; border: 1px solid gray;  background-color: ; color: black;">									
					<label for=f.tblId style="font-weight:normal; padding:0px;"> {{f.tblComments}}:</label> 
					<input type="{{f.tblInputType}}" id="f.tblId" class="form-control" ng-style="f.tblStyle" name="LabM_{{$index}}"  ng-click='checkBMain(f.tblId, f.tblName, $index)' ng-disabled="f.ngEnaDis" ng-model="f.tblName" ng-checked="f.tblChecked" > 								
				</div>
			</div>
			</div> 
			<?php 
			}
function relRecords() {
			echo "<div class='row-fluid table-responsive' ng-show='showAssNav' style='border: 1px solid; border-radius:7px;'>"; 
			echo "<span style='float:left; margin-left:0px;'><button id='collapseA' style='border-radius:5px;' class=''  ng-click='collapseAss()'></button></span>";						
			echo "<div style='margin-left:30px;'>"; funcNavAss(); echo "</div>";
			echo "<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3 table table-responsive'   style='display:inline-block;' >";?>	
			</div>		
			<div ng-repeat="b in assC1">
			<div ng-if="$index===1" id="summyAss"  class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style="margin:0px; height: 115px; float:right; border-radius: 4px; border: 3px solid gray; "></div>
			<div ng-if="b.tblNgIf" class="col-xs-3 col-sm-3 col-md-3 col-lg-3"  style="float: left; border-radius: 4px; border: 1px solid;">
				<label for=b.tblId style="font-weight:normal;">{{b.tblComments}}:</label>			 
				<div ng-class="{'has-error': frmP['Label_' + $index].$invalid, 'has-success': !frmP['Label_' + $index].$invalid}"> 
				<input type="{{b.tblInputType}}"  id="b.tblId" class="form-control" name="Label_{{$index}}" ng-model="b.tblName"   ng-checked="b.tblChecked" ng-model-options="{ debounce: { default: 500, blur: 100 } }" ng-pattern="b.tblPat" ng-style="b.tblStyle" ng-disabled="b.assngEnaDis" autocomplete=off uib-typeahead="aList  for aList in autoList(b.tblLabel, selected.R_Table) | filter: $viewValue | limitTo:4" typeahead-wait-ms=10 typeahead-on-select='typeaheadOnSelect(b.tblLabel, $item, $index)' ng-change="assinputChange(frmP['Label_' + $index].$error.pattern, $index)" ng-blur="assinputBlur(b.tblName, $index)">
				</div>		
				<span class="error" ng-show="frmP['Label_' + $index].$error.pattern" style="font-family: Times New Roman, Times, serif; color: red;">Invalid input:Pls try again</span>  			
			</div>
			<div ng-if="!b.tblNgIf" class="col-xs-3 col-sm-3 col-md-3 col-lg-3" style=" float: left; border-radius: 4px; border: 1px solid;">	
				<label for=b.tblId style="font-weight:normal;">{{b.tblComments}}:</label>
				<div ng-class="{'has-error': frmP['Label_' + $index].$invalid, 'has-success': !frmP['Label_' + $index].$invalid}"> 
				<input type="{{b.tblInputType}}"  id="b.tblId" class="form-control" name="Label_{{$index}}" ng-model="b.tblName"  ng-checked="b.tblChecked" ng-pattern="b.tblPat" ng-style="b.tblStyle" ng-disabled="b.assngEnaDis" autocomplete=off uib-typeahead="aList  for aList in autoList2(b.tblLabel, selected.R_Table) | filter: $viewValue | limitTo:4" typeahead-wait-ms=10 typeahead-on-select='typeaheadOnSelect3(b.tblLabel, $item, $index)' ng-change="assinputChange(frmP['Label_' + $index].$error.pattern, $index)" ng-blur="assinputBlur(b.tblName, $index)">
				</div>		
				<span class="error" ng-show="frmP['Label_' + $index].$error.pattern" style="font-family: Times New Roman, Times, serif; color: red;">Invalid input:Pls try again</span>  			
			</div>			 
			</div> 		
			
			<div ng-repeat="b in assC2"> 
				<div class="col-xs-1 col-sm-1 col-md-1 col-lg-1"  style="border-radius: 4px; border: 1px solid; "> 
					<label for=b.tblId style="font-weight:normal; ">{{b.tblComments}}: </label> 
					<input type="{{b.tblInputType}}"  id="b.tblId" class="form-control" name="Label_{{$index}}" ng-click="checkBAss(b.tblId, b.tblName, $index)" ng-model="b.tblName" ng-checked="b.tblChecked" ng-pattern="b.tblPat" ng-style="b.tblStyle" ng-disabled="b.assngEnaDis"  ng-change="asscheckBoxV(b.tblName,$index)" ng-true-value=true ng-false-value=false>
				</div>				
			</div>			
		<?php  echo "<div class='row-fluid table-responsive' ng-show='showAssNav' style='border: 1px solid; border-radius:7px;'>";  ?>
			<div ng-repeat="b in assC3">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="float:left; height: 150px; border-radius: 4px; border: 1px solid; color: black;">
					<label for="b.tblId" style="font-weight:normal;"> {{b.tblComments}} </label>
					<textarea rows="3" class="form-control" style="resize:none;" spellcheck="true" placeholder="Type progress Note Here!" id="b.tblId" name="Label_{{$index}}" ng-model="b.tblName"  ng-pattern="b.tblPat" ng-style="b.tblStyle" ng-disabled="b.assngEnaDis" ng-trim=true ng-change="assinputChange(frmP['Label_' + $index].$error.pattern, $index)" ng-blur="assinputBlur(b.tblName, $index)"></textarea> 
				</div>
		<?php  echo "</div>";  ?>

		<?php				
		echo"<div id=doc></div>";
	
		echo "</div>";
}
function funcNavigation() {
					echo "<span style='float:right; margin-right:20px;'><button style='border-radius:5px;' ng-disabled='true' class='btn'>Record <i><b style='color:red'>{{rowNo+1}} </b></i> of <i><b style='color:red'>{{Records.length}}</b></i></button></span>";
					echo "<span><button style='border-radius:5px;' radius:5px;' type='submit' ng-disabled='firstBtn' class='btn' ng-click='firstRecord()' name='first' value='First'><span>&#9198;</span></button></span>";
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='prevBtn' class='btn' ng-click='previousRecord()' name='prev' value='prev'><span>&laquo;</span></button></span>";			
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='nextBtn' class='btn' ng-click='nextRecord()' name='next' value='next'><span>&raquo;</span> </button></span>";
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='lastBtn' class='btn' ng-click='lastRecord()' name='last' value='last'><span> &#9197;</span></button></span>";
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='editBtn' class='btn' ng-click='editRecord()' name='edit' value='edit'><span>&#9998;</span></button></span>";
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='newBtn' class='btn' ng-click='addnewRecord()' name='addnewRecord' value='add'><span>&CirclePlus;</span></button></span>"; ?>
				<input  style="border-radius:7px;" type="text"  id="searchMain" class="form-control" name="searchMain" ng-model="searchMain" placeholder="search main record!" ng-pattern="" autocomplete=off uib-typeahead="aL  for aL in searchList(pK, selected.M_Table) | filter: $viewValue | limitTo:8" typeahead-wait-ms=10 typeahead-on-select="typeaheadOnSelectsearch(pK, $item, $index)">
				<?php  echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='deleteBtn' class='btn' ng-click='deleteRecord()' name='delete' value='delete'><span class='label label-danger'>&cross;</span></button></span>";		
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='insertBtn' class='btn' ng-click='insertRecord()' name='insert' value='insert'>Insert</button></span>";		
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='cancelBtn' class='btn' ng-click='cancel()' name='cancel' value='cancel'><span>&#10062;</span></button></span>";		
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='saveBtn' class='btn' ng-click='saveRecord()' name='save' value='save'><span>&#9989;</span></button></span>";
				}
function funcNavAss() {
				    echo "<span style='float:right; margin-right:20px;'><button style='border-radius:5px;' ng-disabled='true' class='btn'>Record <i><b style='color:red'> {{assrowNo+1}} </b></i> of <i><b style='color:red'> {{assRecordsInfo.length}}</b></i></button></span>";				
					echo "<span'><button style='border-radius:5px;' type='submit' ng-disabled='assfirstBtn' class='btn' ng-click='assfirstRecord()' name='assfirst' value='assFirst'<span>&#9198;</span></button></span>";
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='assprevBtn' class='btn' ng-click='asspreviousRecord()' name='assprev' value='assprev'><span>&laquo;</span></button></span>";			
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='assnextBtn' class='btn' ng-click='assnextRecord()' name='assnext' value='assnext'><span>&raquo;</span></button></span>";
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='asslastBtn' class='btn' ng-click='asslastRecord()' name='asslast' value='asslast'><span>&#9197;</span></button></span>";
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='asseditBtn' class='btn' ng-click='asseditRecord()' name='assedit' value='assedit'><span>&#9998;</span></button></span>"; 					
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='assnewBtn' class='btn' ng-click='assaddnewRecord()' name='assaddnewRecord' value='assadd'><span>&CirclePlus;</span></button></span>"; ?>
					<input style="border-radius:7px;" type="text"  id="searchRelated" class="form-control" name="searchRelated" ng-model="searchRelated" placeholder="search record!" ng-pattern="" autocomplete=off uib-typeahead="aL  for aL in searchListRel(asspK, rtSelected.Table_Name) | filter: $viewValue | limitTo:8" typeahead-wait-ms=10 typeahead-on-select="typeaheadOnSelectsearchRel(asspK, $item, $index)">								
					<?php echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='assdeleteBtn' class='btn' ng-click='assdeleteRecord()' name='assdelete' value='assdelete'><span class='label label-danger'>&cross;</span></button></span>";		
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='assinsertBtn' class='btn' ng-click='assinsertRecord()' name='assinsert' value='assinsert'>insert</button></span>";		
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='asscancelBtn' class='btn' ng-click='asscancel()' name='asscancel' value='asscancel'><span>&#10062;</span></button></span>";		
					echo "<span><button style='border-radius:5px;' type='submit' ng-disabled='asssaveBtn' class='btn' ng-click='asssaveRecord()' name='asssave' value='asssave'><span>&#9989;</span></button></span>";
				}
		?>
</div>
