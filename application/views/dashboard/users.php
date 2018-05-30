<?php $this->load->view('dashboard/header'); ?>
<div class="container">
    <!-- Page Heading End-->
    <div class="row margin-top-30">
        <div class="table-responsive">
            <table id="example" class="table table-bordered  table-hover table-striped" data-page-length='25'>
                <thead>
                    <tr>
                        <th class="weight-300 font-12">First Name</th>
                        <th class="weight-300 font-12">Last Name</th>
                        <th class="weight-300 font-12">Email</th>
                        <th class="weight-300 font-12">Status</th>
                        <th class="weight-300 font-12">Role</th>
                        <th class="weight-300 font-12">Agency</th>
                        <th class="weight-300 font-12">Country</th>
                        <th class="weight-300 font-12">Change Password</th>
                    </tr>
                </thead>
                <tbody class="list_body">
                    <?php if (isset($users) && count($users) > 0) : ?>
                        <?php foreach ($users as $user): ?>
                            <?php if ($user['email'] !== $this->session->email) : ?>
                                <tr>
                                    <td class="sm-td"> <div class="padding-2"><?= $user['firstname']; ?></div></td>
                                    <td class="sm-td"><div class="padding-2"><?= $user['surname']; ?></div></td>
                                    <td class="sm-td"><div class="padding-2"><?= $user['email']; ?></div></td>
                                    <td class="sm-td"><div class="padding-2"><?= (isset($user['status']) && $user['status'] == "0") ? "Inactive" : "Active"; ?></div></td>
                                    <td class="sm-td"><div class="padding-2"><?= (isset($user['role']) && $user['role'] == "0") ? "Normal" : "Admin"; ?></div></td>
                                    <td class="sm-td"><div class="padding-2"><?= $user['agency_name']; ?></div></td>
                                    <td class="sm-td"><div class="padding-2"><?= $user['country_name']; ?></div></td>
                                    <td><a class="btn btn-sm btn-block btn-success" href="<?= site_url('user/show/' . $user['id']) ?>">Change Password</a></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php $this->load->view('dashboard/footer'); ?>
<script>
    $('#example2').DataTable({
        "searching": false,
        "columnDefs": [{
                "orderable": false,
                "targets": [8, 9, 10]
            }],
    });
</script>