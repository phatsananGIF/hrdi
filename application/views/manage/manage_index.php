<h1>Manage</h1>
<?php 
    echo form_open('Manage/run');
    echo form_label('เลือกรายการ ');
    echo form_dropdown('command', $command, 'patch');
    echo form_submit('mysubmit', 'Submit');
    echo form_fieldset('Sites');
?>
    <table border="1">
        <thead>
        <tr>
            <th>No</th>
            <th>#</th>
            <th>Code</th>
            <th>Name</th>
            <th>IP</th>
            <th>S.v</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
<?php 
$i=0;
foreach($sites->result() as $rows )
{
    $i++;
?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo form_checkbox('sites[]', $rows->site_code , FALSE) ?></td>
                <td><?php echo $rows->site_code?></td>
                <td><?php echo $rows->site_name?></td>
                <td><?php echo $rows->ipaddr?></td>
                <td><?php echo $rows->software_version?></td>
                <td> </td>
            </tr>
<?php 
}
?>
        </tbody>
    </table>
<?php
    echo form_fieldset_close();
    echo form_close();
?>