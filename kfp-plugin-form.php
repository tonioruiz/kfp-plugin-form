<?php
/**
 * Plugin Name: KFP Plugin Form
 * Author: Tonio Ruiz
 * Version: 0.1
 * Description: Plugin para crear un formulario personalizado. Utiliza el shortcode [kfp_plugin_form]
 */

// Define el shortcode que pinta el formulario
add_shortcode('kfp_plugin_form', 'Kfp_Plugin_form');

/**
 * Crea el shortcode
 *
 * @return void
 */
function Kfp_Plugin_form()
{
    global $wpdb;

    if ($_POST['nombre'] != ''
        AND is_email($_POST['correo'])
        AND $_POST['nivel_html'] != ""
        AND $_POST['nivel_css'] != ""
        AND $_POST['nivel_js'] != ""
        AND $_POST['aceptacion'] == '1'
    ) {
        $tabla_aspirante = $wpdb->prefix . 'aspirante';
        $nombre = sanitize_text_field($_POST['nombre']);
        $correo = sanitize_email($_POST['correo']);
        $nivel_html = (int)$_POST['nivel_html'];
        $nivel_css = (int)$_POST['nivel_css'];
        $nivel_js = (int)$_POST['nivel_js'];
        $aceptacion = (int)$_POST['aceptacion'];
        $created_at = date('Y-m-d H:i:s');
        $wpdb->insert(
            $tabla_aspirante, 
            array(
                'nombre' => $nombre,
                'correo' => $correo,
                'nivel_html' => $nivel_html,
                'nivel_css' => $nivel_css,
                'nivel_js' => $nivel_js,
                'aceptacion' => $aceptacion,
                'created_at' => $created_at,
            )
        );
    }

    ob_start();
    ?>
    <form action="<?php get_the_permalink(); ?>" method="post"
        class="cuestionario">
        <div class="form-input">
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" id="nombre" required>
        </div>
        <div class="form-input">
            <label for='correo'>Correo</label>
            <input type="email" name="correo" id="correo" required>
        </div>
        <div class="form-input">
            <label for="nivel_html">¿Cuál es tu nivel de HTML?</label>
            <input type="radio" name="nivel_html" value="1" required> Nada
            <br><input type="radio" name="nivel_html" value="2" required> Estoy 
                aprendiendo
            <br><input type="radio" name="nivel_html" value="3" required> Tengo 
                experiencia
            <br><input type="radio" name="nivel_html" value="4" required> Lo 
                domino al dedillo
        </div>
        <div class="form-input">
            <label for="nivel_css">¿Cuál es tu nivel de CSS?</label>
            <input type="radio" name="nivel_css" value="1" required> Nada
            <br><input type="radio" name="nivel_css" value="2" required> Estoy 
                aprendiendo
            <br><input type="radio" name="nivel_css" value="3" required> Tengo 
                experiencia
            <br><input type="radio" name="nivel_css" value="4" required> Lo 
                domino al dedillo
        </div>
        <div class="form-input">
            <label for="nivel_js">¿Cuál es tu nivel de JavaScript?</label>
            <input type="radio" name="nivel_js" value="1" required> Nada
            <br><input type="radio" name="nivel_js" value="2" required> Estoy 
                aprendiendo
            <br><input type="radio" name="nivel_js" value="3" required> Tengo 
                experiencia
            <br><input type="radio" name="nivel_js" value="4" required> Lo domino 
al dedillo
        </div>
        <div class="form-input">
            <label for="aceptacion">La información facilitada se tratará 
            con respeto y admiración.</label>
            <input type="checkbox" id="aceptacion" name="aceptacion"
value="1" required> Entiendo y acepto las condiciones
        </div>
        <div class="form-input">
            <input type="submit" value="Enviar">
        </div>
    </form>
    <?php
    return ob_get_clean();
}