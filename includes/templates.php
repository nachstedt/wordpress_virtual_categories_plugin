<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class etax_Templates
{
    
    public static function taxonomy_edit($args)
    { 
?>
<div class="wrap">
  <h2>Edit Taxonomy</h2>
  <form action='<?php echo $args["form-url"]?> ' method='post'>
    <input type='hidden' name='action' value='save'/>
    <input type='hidden' name='taxonomy' value='<?php echo $args["name"]?>' />
    <input type='hidden' name='noheader' value='1' />
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="name">Name</label>
          </th>
          <td>
<?php if ($args["builtin"]) { ?>
            <?php echo $args["name"] ?>
<?php } else { ?>
            <input type="text" name="name" />
<?php } ?>
            <p class="description">
              Internal name of the taxonomy in slug form
            </p>
          </td>
        </tr>
        <tr>
          <th scope="row">Builtin</th>
          <td>
            <?php echo $args["builtin"] ? "yes" : "no"?>
            <p class="description">
              Builtin categories cannot be modified but only disabled
            </p>
          </td>
          
        </tr>
        <tr>
          <th scope="row">Disable Taxonomy</th>
          <td>
            <fieldset>
              <label for="disabled">
                <input type='checkbox' name='disabled' <?php 
                    echo $args["disabled"] ? "checked" : ""?> />
                Disabled
              </label>      
            </fieldset>  
          </td>
        </tr>
      </tbody>
    </table>
    <p class="submit">
      <input type='submit' value='Update' />
    </p>
  </form>    
</div>
<?php
    }
    
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
        $alternate = FALSE;
        foreach ($args["builtin_taxonomies"] as $taxonomy)
        {
?>
            <tr class="<?php echo $alternate ? "alternate" : ""?>">
              <td>
                <a href='<?php echo $taxonomy['url']; ?>'>
                  <?php echo $taxonomy['name'];?>
                </a>
              </td>
              <td><?php echo $taxonomy["disabled"]?"yes":"no" ?></td>
            </tr>
<?php
            $alternate = !$alternate;
        }
?>
          </tbody>
        </table>
        <h3>Additional Taxonomies</h3>
        <table class="widefat">
          <thead>
            <tr>
              <th>Name</th>
              <th>Type</th>
            </tr>
<?php
        $alternate = FALSE;
        foreach($args['additional_taxonomies'] as $taxonomy)
        {
?>
            <tr class="<?php echo $alternate ? "alternate" : ""?>">
              <td>
                <a href='<?php echo $taxonomy['url']; ?>'>
                  <?php echo $taxonomy['name'];?>
                </a>  
              </td>
              <td><?php echo $taxonomy['type'] ?></td>
            </tr>
<?php            
            $alternate = !$alternate;
        }
?>
          </thead>
        </table>
      </div>
    </div>
    <div id='col-left'>
      <div class='col-wrap'>
        <div class="form-wrap">
          <h3>Add New Taxonomy</h3>
          <form method='post' action='<?php echo $args["form-url"]; ?>'>
            <input type="hidden" name="action" value="add-taxonomy" />
            <input type="hidden" name="noheader" value="1" />
            <div class='form-field form-required'>
              <label for='taxonomy-label-name'>Label</label>
              <input name='taxonomy-label-name' id='taxonomy-name' size='40' 
                     type='text'/>
              <p>
                General name for the taxonomy, usually plural.
              </p>
            </div>
            <div class='form-field'form-required>
              <label for="taxonomy-slug">Name</label>
              <input name='taxonomy-slug' id="taxonomy-slug" size="40" 
                     tyoe='text' />
              <p>
                The name of the taxonomy. Name should be in slug form (must not 
                contain capital letters or spaces) and not more than 32 
                characters long (database structure restriction).
              </p>
            </div>
            <div class='form-field'>
              <label for="type">Type</label>
              <select name="taxonomy-type" class="postform">
                <option class="level-0" value="regular">Regular</option>
                <option class="level-0" value="logical">Logical</option>                                
              </select>
              <p>
                  <strong>Regular</strong> taxonomies are standard taxonomies 
                  that behave like the builtin "category" or "post_tag" 
                  taxonomies. <br />
                  <strong>Logical</strong> taxonomies are taxonomies whose terms 
                  cannot be directly attached to posts but are defined by 
                  logical rules.
              </p>
            </div>
            <p class="submit">
              <input type="submit" name="submit" id="submit" 
                     class="button button-primary" value="Add New Taxonomy" />
            </p>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
    }
}
