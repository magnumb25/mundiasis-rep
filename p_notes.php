<?php

if (getConnectedUserType() == "stud")
  header('location: indexx.php?page=e_notes');

?>

<section class="content-header">
  <h1>
    Notes
    <small> - Gestion des notes</small>
  </h1>
  <ol class="breadcrumb unselectable-setting" id="session-info">
    Année universitaire 
    <?php
    echo getSelectedAnneeUniversitaire()." - ";
    if(getSelectedSemester() == "S1") echo "Semestre 1"; 
    elseif(getSelectedSemester() == "S2") echo"Semestre 2";
    ?>
  </ol>
</section>

<section class="content">
  <div class="box noPrint">
    <div class="box-header">
      <h3 class="box-title">Selection du cours</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <div class="box-body">
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-md-2 control-label" for="coursOfConnectedProf">Liste des cours</label>
          <div class="col-md-7">
            <select id="coursOfConnectedProf" name="coursOfConnectedProf" class="form-control" required="">
              <option value="">Select...</option>
              <?php
              foreach (getCoursOfProf() as $data) {
                $code_ref = $data['code_referentiel'];
                ?>
                <option value="<?php echo $data['code_cours']?>">
                  <?php echo $data['libelle_niveau']." ".$data['libelle_filiere'] ." - ".$data['libelle_cours']?> 
                </option> 
                <?php  
              }
              ?>  
              
            </select>
          </div>
          <div class="col-md-3" id="marksFile">
            <!--<a href="uploadFile.php" class="btn btn-primary"><i class="fa fa-upload"></i> Importer les notes</a>--> 
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="box">
    <div class="box-header noPrint">
      <h3 class="box-title">Saisie des notes</h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>

    <div class="box-body">
      <div class="col-md-12">
        <div class="tabbable-panel">
          <div class="tabbable-line">
            <ul class="nav nav-tabs no-print ">
              <li class="active" id="li_default_1">
                <a href="#tab_default_1" data-toggle="tab" aria-expanded="true" id="tab_default_1_choice">  Session normale </a>
              </li>
              <li class="" id="li_default_2">
                <a href="#tab_default_2" data-toggle="tab" aria-expanded="false" id="tab_default_2_choice">
                  Session de ratrappage 
                </a>
              </li>
              <li class="" id="li_default_3">
              <a href="#tab_default_3" data-toggle="tab" aria-expanded="false" id="tab_default_3_choice">
                  Résultat final 
                </a>
              </li>
            </ul>
            <br>
            <br>

            <div class="tab-content">
              <div class="tab-pane active" id="tab_default_1">
                <div class="col-md-12">
                  <div>
                    <form class="form-horizontal" id="form-affectNotesToStudent">
                      <div class="pull-left col-md-2" id="p_printDiv"></div>
                      <div id="ListOfStudentFollowingTheCourse" class="table-responsive col-md-8"></div>
                      <div class="pull-right col-md-2" id="addButtonDiv"></div>
                    </form>
                  </div>
                </div>

              </div>
              <div class="tab-pane" id="tab_default_2">
                <div class="col-md-12">
                  <div>
                    <form class="form-horizontal" id="form-affectNotesToStudent2">
                      <div class="pull-left col-md-2" id="p_printDiv2"></div>
                      <div id="ListOfStudentHavingRatrappage" class="table-responsive col-md-8"></div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="tab_default_3">
                <div class="col-md-12">
                  <div>
                    <form class="form-horizontal" id="form-affectNotesToStudent2">
                      <div class="pull-left col-md-12" id="p_printDiv3"></div>
                      <br><br>
                      <div id="FinalResult" class="table-responsive col-md-12"></div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




    </div>





  </div>
</section>
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="dist/js/functions.js"></script>
<script type="text/javascript">
  var someVarName = localStorage.getItem("id_cours");
  var element = document.getElementById('coursOfConnectedProf');
  if (someVarName !== null) {
    element.value = someVarName;
      //console.log("local - "+localStorage.getItem("id_cours"));
      localStorage.setItem("id_cours", "");
      getStudentFollowingCourse(someVarName);
      showAddTestButton(someVarName);
      showDownMarksFileButton(someVarName);
      showPrintButton_p(someVarName);
    }
  </script>