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
		$disabled = $args["builtin"] ? "disabled" : "";
?>
<div class="wrap">
  <h2>Edit Taxonomy</h2>
  <form action='<?php echo $args["form-url"]?> ' method='post'>
    <input type='hidden' name='action' value='save'/>
    <input type='hidden' name='taxonomy' value='<?php echo $args["name"]?>' />
    <input type='hidden' name='noheader' value='1' />
    <h3>General</h3>
    <table class="form-table">
      <tbody>
        <tr>
          <th scope="row">
            <label for="name">Name</label>
          </th>
          <td>
            <input type="text" name="name" id="name" 
                   value="<?php echo $args["name"] ?>" 
				<?php echo $disabled?>/>
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
            <th scope="row"><label for="disabled">Disable Taxonomy</label></th>
          <td>
            <fieldset>
              <label for="disabled">
                <input type='checkbox' name='disabled' id="disabled" <?php 
                    echo $args["disabled"] ? "checked" : ""?> />
                Disabled
              </label>      
            </fieldset>  
          </td>
        </tr>
      </tbody>
    </table>
    <h3>Labels</h3>
    <table class="form-table">
      <tbody>
<?php
            $labels = array(
                array(
                    "name" => "name",
                    "label" => "Name",
                    "text" => "General name for the taxonomy, usually plural.",
                    "value" => $args["labels"]["name"],
                    "default" => array(
                        _x( 'Post Tags', 'taxonomy general name' ),
                        _x( 'Categories', 'taxonomy general name' ))),
                array(
                    "name" => "singular_name",
                    "label" => "Singular Name",
                    "text" => "Name for one object of this taxonomy.",
                    "value" => $args["labels"]["singular_name"],
                    "default" => array(
                        _x( 'Post Tag', 'taxonomy singular name'),
                        _x( 'Category', 'taxonomy singular name'))),
                array(
                    "name" => "menu_name",
                    "label" => "Menu Name",
                    "value" => $args["labels"]["menu_name"],
                    "default" => "same as Name"),
                array(
                    "name" => 'all_items',
                    "label" => 'All Items',
                    "value" => $args["labels"]["all_items"],
                    "default" => array(
                        __('All Tags'), 
                        __('All Categories'))),
                array(
                    "name" => 'edit_item',
                    "label" => "Edit Item",
                    "value" => $args["labels"]["edit_item"],
                    "default" => array(
                        __( 'Edit Tag' ),
                        __( 'Edit Category' ))),
                array(
                    "name" => 'view_item',
                    "label" => "View Item",
                    "value" => $args["labels"]["view_item"],
                    "default" => array(
                        __( 'View Tag' ),
                        __( 'View Category' ))),
                array(
                    "name" => 'update_item',
                    "label" => "Update Item",
                    "value" => $args["labels"]["update_item"],
                    "default" => array(
                        __( 'Update Tag' ),
                        __( 'Update Category' ))),
                array(
                    "name" => 'add_new_item',
                    "label" => "Add New Item",
                    "value" => $args["labels"]["add_new_item"],
                    "default" => array(
                        __( 'Add New Tag' ),
                        __( 'Add New Category' ))),
                array(
                    "name" => 'new_item_name',
                    "label" => 'New Item Name',
                    "value" => $args['labels']['new_item_name'],
                    "default" => array(
                        __( 'New Tag Name' ),
                        __( 'New Category Name' ))),
                array(
                    "name" => 'parent_item',
                    "label" => 'Parent Item',
                    "text" => "This string is not used on non-hierarchical "
                              . "taxonomies such as post tags.",
                    "value" => $args['labels']['parent_item'],
                    "default" => array(
                        NULL,
                        __( 'Parent Category' )
                    )),
                array(
                    "name" => 'parent_item_colon',
                    "label" => 'Parent Item with colon',
                    "text" => 'The same as parent item, but with colon : in '
                              . 'the end',
                    "value" => $args['labels']['parent_item_colon'],
                    "default" => array(
                        NULL,
                        __( 'Parent Category:' ))),
                array(
                    "name" => 'search_items',
                    "label" => 'Search Items',
                    "value" => $args['labels']['search_items'],
                    "default" => array(
                        __( 'Search Tags' ),
                        __( 'Search Categories' ))),
                array(
                    "name" => "popular_items",
                    "label" => "Popular Items",
                    "value" => $args["labels"]["popular_items"],
                    "default" => array(
                        __( 'Popular Tags' ),
                        NULL)),
                array(
                    "name" => "separate_items_with_commas",
                    "label" => "Separate Items with Commas",
                    "text" => "The separate item with commas text used in the "
                              . "taxonomy meta box. This string isn't used on "
                              . "hierarchical taxonomies.",
                    "value" => $args["labels"]["separate_items_with_commas"],
                    "default" => array(
                        __( 'Separate tags with commas' ),
                        NULL)),
                array(
                    "name" => "add_or_remove_items",
                    "label" => "Add or Remove Items",
                    "text" => "The add or remove items text and used in the "
                              . "meta box when JavaScript is disabled. This "
                              . "string isn't used on hierarchical taxonomies.",
                    "value" => $args["labels"]["add_or_remove_items"],
                    "default" => array(
                        __( 'Add or remove tags' ),
                        NULL)),
                array(
                    "name" => "choose_from_most_used",
                    "label" => "Choose from most used",
                    "text" => "The choose from most used text used in the "
                              . "taxonomy meta box. This string isn't used on "
                              . "hierarchical taxonomies. ",
                    "value" => $args["labels"]["choose_from_most_used"],
                    "default" => array(
                        __( 'Choose from the most used tags' ),
                        NULL)),
                array(
                    "name" => "not_found",
                    "label" => "Not Found",
                    "text" => "the text displayed via clicking 'Choose from "
                              . "the most used tags' in the taxonomy meta box "
                              . "when no tags are available. This string isn't "
                              . "used on hierarchical taxonomies.",
                    "value" => $args["labels"]["not_found"],
                    "default" => array(
                        __( 'No tags found.' ),
                        NULL))
            );
            foreach ($labels as $label)
            {
?>
		<tr>
          <th scop="row">
            <label for="labels-<?php echo $label['name']?>"> 
              <?php echo $label['label']?>
            </label>
          </th>
          <td>
            <input type="text" name="labels[<?php echo $label['name']?>]" 
                   id="labels-<?php echo $label['name']?>" 
                   value="<?php echo $label["value"]?>" 
                   <?php echo $disabled?> />
            <span class="description"> 
                Default: 
<?php           
                if (is_array($label["default"]))
                {
                    echo '"' . $label['default'][0] 
                         .'" / "' . $label['default'][1] . '"';
                }
                else
                {
                    echo $label['default'];
                }
?>
            </span>
<?php
                if (isset($label['text']))
                {
?>
            <p class="description"><?php echo $label['text']?></p>
<?php
                }
?>
          </td>
        </tr>                
<?php
            }
                    
?>
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
