<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class etax_Templates
{
    
    public static function taxonomy_manager_overview($args) 
    {
?>
<div class='wrap'>
    <h2>Taxonomies</h2>
    <div id='col-container'>
        <div id='col-right'>
            <div class='col-wrap'>
                <h3>Builtin Taxonomies</h3>
                <table class="widefat">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Disabled</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
        foreach ($args["builtin_taxonomies"] as $taxonomy)
        {
?>
                        <tr class="alternate">
                            <td>
                                <a href='<?php echo $taxonomy['url']; ?>'><?php echo $taxonomy['name'];?></a>
                            </td>
                            <td><?php echo $taxonomy["disabled"] ? "yes" : "no" ?></td>
                        <tr>
<?php
        }
?>
                    </tbody>
                </table>
            </div>
        </div>
        <div id='col-left'>
            <div class='col-wrap'>
                <h3>Add New Taxonomy</h3>
                <form method='post'>
                    <div class='form-field form-required'>
                        <label for='taxonomy-name'>Name</label>
                        <input name='taxonomy-name' id='taxonomy-name' size='40' type='text'/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    }
}
