<?php
class StudentView
{
  public function render($data, $formData = null, $departments = [])
  {
      $no = 1;
      $dataStudent = " ";
      
      // 1. Buat dropdown department
      $departmentOptions = '';
      foreach ($departments as $dept) {
          $selected = (isset($formData[5]) && $formData[5] == $dept['id']) ? 'selected' : '';
          $departmentOptions .= "<option value='{$dept['id']}' $selected>{$dept['name']}</option>";
      }
      
      // 2. Loop data student + department
      foreach ($data as $val) {
          list($id, $name, $nim, $phone, $join_date, $id_dept, $dept_name) = $val;
          $dataStudent .= "<tr>
                      <td>" . $no++ . "</td>
                      <td>" . $name . "</td>
                      <td>" . $nim . "</td>
                      <td>" . $phone . "</td>
                      <td>" . $join_date . "</td>
                      <td>" . ($dept_name ?? '-') . "</td>
                      <td>
                        <a href='index.php?id_edit=" . $id . "' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='index.php?id_hapus=" . $id . "' class='btn btn-danger btn-sm'>Delete</a>
                      </td>
                    </tr>";
      }

      $tpl = new Template("templates/Student.html");
      
      // 3. Replace semua placeholder
      $tpl->replace("JUDUL", "Student Management");
      $tpl->replace("DATA_TABEL", $dataStudent);
      $tpl->replace("DEPARTMENT_DROPDOWN", $departmentOptions);

      // 4. Handle form data
      $formId = $formData[0] ?? '';
      $formName = $formData[1] ?? '';
      $formNim = $formData[2] ?? '';
      $formPhone = $formData[3] ?? '';
      $formJoinDate = $formData[4] ?? date('Y-m-d');
      $formDept = $formData[5] ?? '';
      
      $actionButton = $formId ? 'update' : 'submit';
      $actionLabel = $formId ? 'Edit Student' : 'Add Student';

      $tpl->replace("ID", $formId);
      $tpl->replace("NAME", $formName);
      $tpl->replace("NIM", $formNim);
      $tpl->replace("PHONE", $formPhone);
      $tpl->replace("JOIN_DATE", $formJoinDate);
      $tpl->replace("ACTION_BUTTON", $actionButton);
      $tpl->replace("ACTION", $actionLabel);
      
      $tpl->write();
  }
}