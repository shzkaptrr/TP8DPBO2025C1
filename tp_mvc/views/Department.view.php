<!-- Department.view.php -->

<?php
class DepartmentView
{
  public function render($data, $formData = null)
  {
      $no = 1;
      $dataDepartment = " ";
      
      foreach ($data as $val) {
          list($id, $name, $code) = $val;
          $dataDepartment .= "<tr>
                      <td>" . $no++ . "</td>
                      <td>" . $name . "</td>
                      <td>" . $code . "</td>
                      <td>
                        <a href='department.php?id_edit=" . $id . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='department.php?id_hapus=" . $id . "' class='btn btn-danger btn-sm'>Delete</a>
                      </td>
                    </tr>";
      }
  
      $tpl = new Template("templates/Department.html");
      
      $tpl->replace("JUDUL", "Department Management");
      $tpl->replace("DATA_TABEL", $dataDepartment);
  
      $formId = isset($formData[0]) ? $formData[0] : '';
      $formName = isset($formData[1]) ? $formData[1] : '';
      $formCode = isset($formData[2]) ? $formData[2] : '';
      $actionButton = $formId ? 'update' : 'submit';
      $actionLabel = $formId ? 'Edit Department' : 'Add Department';
  
      $tpl->replace("ID", $formId);
      $tpl->replace("NAME", $formName);
      $tpl->replace("CODE", $formCode);
      $tpl->replace("ACTION_BUTTON", $actionButton);
      $tpl->replace("ACTION", $actionLabel);
      
      $tpl->write();
  }
}