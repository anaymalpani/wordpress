<?php 

function themeum_option_element( $name, $attr_option, $type, $shortcode ){
    
    $option_element = null;

    if( !isset($attr_option['value']) ) $attr_option['value']='';
    
    (isset($attr_option['desc']) && !empty($attr_option['desc'])) ? $desc = '<p class="description">'.$attr_option['desc'].'</p>' : $desc = '';

    switch( $attr_option['type'] ){
        
        case 'radio':

        $option_element .= '<div class="label"><strong>'.$attr_option['title'].': </strong></div><div class="content">';
        foreach( $attr_option['opt'] as $val => $title ){

            (isset($attr_option['def']) && !empty($attr_option['def'])) ? $def = $attr_option['def'] : $def = '';

            $option_element .= '
            <label for="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'">'.$title.'</label>
            <input class="attr" type="radio" data-attrname="'.$name.'" name="'.$shortcode.'-'.$name.'" value="'.$val.'" id="shortcode-option-'.$shortcode.'-'.$name.'-'.$val.'"'. ( $val == $def ? ' checked="checked"':'').'>';
        }
        
        $option_element .= $desc . '</div>';
        
        break;
        
        case 'checkbox':
        
        $option_element .= '<div class="label"><label for="' . $name . '"><strong>' . $attr_option['title'] . ': </strong></label></div>    <div class="content"> <input type="checkbox" class="' . $name . '" id="' . $name . '" />'. $desc. '</div> ';
        
        break;  

        case 'select':
        
        $option_element .= '
        <div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        
        <div class="content"><select id="'.$name.'">';
        $values = $attr_option['values'];
        foreach( $values as $index=>$value ){
            $option_element .= '<option value="'.$index.'">'.$value.'</option>';
        }
        $option_element .= '</select>' . $desc . '</div>';
        
        break;  

        case 'icon':
        case 'class':
        
        $option_element .= '
        <div class="label"><label for="'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        
        <div class="content"><select id="'.$name.'">';
        $values = $attr_option['values'];
        $option_element .= '<option value=""> -None- </option>';
        foreach( $values as $index=>$value ){
            $option_element .= '<option value="'.$value.'">'.$value.'</option>';
        }
        $option_element .= '</select>' . $desc . '</div>';
        
        break;
        
        case 'icons':
        
        $option_element .= '

        <div class="icon-option">';
        $values = $attr_option['values'];
        foreach( $values as $value ){
            $option_element .= '<i class="'.$value.'"></i>';
        }
        $option_element .= $desc . '</div>';
        
        break;
        
        case 'custom':


        if( $name == 'progressbar' ){
            $option_element .= '
            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">

                    <div class="label">
                        <label><strong>Style:  </strong> eg. Danger</label>
                    </div>

                    <div class="content">
                        <select id="style" class="shortcode-dynamic-item-style dynamic">
                        <option value=""> None </option>    
                        <option value="progress-bar-success"> Success </option>
                        <option value="progress-bar-warning"> Warning </option>
                        <option value="progress-bar-info"> Info </option>   
                        <option value="progress-bar-danger"> Danger </option>               
                        </select>
                    </div>

                    <div class="label">
                    <label><strong> Width: </strong> eg. 0-100</label>
                    </div>

                    <div class="content">
                    <input id="width" class="shortcode-dynamic-item-width" type="text">
                    </div>  

                    <div class="label">
                    <label><strong> Content: </strong> eg. wordpress</label>
                    </div>

                    <div class="content">
                    <input id="content" class="shortcode-dynamic-item-text" type="text">
                    </div>  


                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'sportson' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'sportson' ).'</a>';
            
        }
        elseif( $name == 'tabs' )
        {
            $option_element .= '
            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">

                    <div class="label">
                    <label><strong> Title: </strong></label>
                    </div>

                    <div class="content">
                    <input id="width" class="shortcode-dynamic-item-title" type="text">
                    </div>  

                    <div class="label">
                    <label><strong>Content: </strong></label>
                    </div>

                    <div class="content">
                    <textarea id="content" class="shortcode-dynamic-item-content"></textarea>
                    </div>
                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'sportson' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'sportson' ).'</a>';
        }
        elseif( $name == 'accordion' )
        {
            $option_element .= '
            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="shortcode-dynamic-item">

                    <div class="label">
                    <label><strong> Title: </strong></label>
                    </div>

                    <div class="content">
                    <input id="width" class="shortcode-dynamic-acc-title" type="text">
                    </div>  

                    <div class="label">
                    <label><strong>Content: </strong></label>
                    </div>

                    <div class="content">
                    <textarea id="content" class="shortcode-dynamic-acc-content"></textarea>
                    </div>
                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'sportson' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'sportson' ).'</a>';
        }

        elseif( $name == 'testimonial' )
        {
            $option_element .= '
            <div class="shortcode-dynamic-items" id="options-item" data-name="item">

                <div class="label">
                <label><strong> Title: </strong></label>
                </div>

                <div class="content" style="margin-bottom:20px;">
                <input id="slide_no" class="shortcode-dynamic-acc-slide-no" type="text">
                </div>

                <div class="shortcode-dynamic-item" style="margin-bottom:20px;">

                    <div class="label">
                    <label><strong> Nuber Of Slide: </strong></label>
                    </div>

                    <div class="content">
                    <input id="name" class="shortcode-dynamic-bbb-title" type="text">
                    </div>

                    <div class="label">
                    <label><strong> Position: </strong></label>
                    </div>

                    <div class="content">
                    <input id="position" class="shortcode-dynamic-bbb-position" type="text">
                    </div>

                    <div class="label">
                    <label><strong>Content: </strong></label>
                    </div>

                    <div class="content">
                    <textarea id="content" class="shortcode-dynamic-bbb-content"></textarea>
                    </div>
                </div>
            </div>

            <a href="#" class="btn yellow remove-list-item">'.__('Remove', 'sportson' ). '</a> 
            <a href="#" class="btn yellow add-list-item">'.__('Add', 'sportson' ).'</a>';
        }
        
        
        break;
        
        case 'textarea':
        $option_element .= '
        <div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        <div class="content"><textarea data-attrname="'.$name.'">'.$attr_option['value'].'</textarea> ' . $desc . '</div>';
        break;

        case 'color':
        $option_element .= '
        <div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        <div class="content"><input class="attr" type="color" data-attrname="'.$name.'" value="'.$attr_option['value'].'" />' . $desc . '</div>';
        break;

        case 'text':
        default:
        $option_element .= '
        <div class="label"><label for="shortcode-option-'.$name.'"><strong>'.$attr_option['title'].': </strong></label></div>
        <div class="content"><input class="attr" type="text" data-attrname="'.$name.'" value="'.$attr_option['value'].'" />' . $desc . '</div>';
        break;
    }
    
    $option_element .= '<div class="clear"></div>';

    return $option_element;
}

