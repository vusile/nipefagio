<div id="container" class = "transparent" style = 'width: 900px; margin: 10px auto; background: #FFF; padding: 10px;'>
<h1><?php echo $title; ?></h1>
<?php echo $text; ?>
<table class="table table-striped table-condensed table-bordered">
<thead>
<th>Company Name</th>
<th>Company Type</th>
<th>Sector</th>
<th>City</th>
<th>Country</th>
<th>Phone</th>
</thead>
<tbody>
<?php foreach ($partners->result() as $partner): ?>
<tr>
<td>
<?php if($partner->website != ''): ?>
<a target = "_blank" href = "<?php echo $partner->website  ?>">
<?php echo $partner->company_name; ?>
</a>
<?php else: ?>
<?php echo $partner->company_name; ?>
<?php endif; ?>
<br>
<?php if($partner->website != '' and $partner->logo != '' ): ?>
<a target = "_blank" href = "<?php echo $partner->website  ?>"><img src = 'images/<?php echo $partner->logo ?>' style = "width: 100px;"/></a>
<?php elseif($partner->website == '' and $partner->logo != '' ): ?>
<img src = 'images/<?php echo $partner->logo ?>' style = "width: 100px;" />

<?php endif; ?>
</td>
<td><?php echo $partner->company_type; ?></td>
<td><?php echo $partner->sector; ?></td>
<td><?php echo $partner->city; ?></td>
<td><?php echo $partner->country; ?></td>
<td><?php echo $partner->phone; ?></td>

</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>