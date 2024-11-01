<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: background
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'CSF_Field_background' ) ) {
  class CSF_Field_background extends CSF_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args                             = wp_parse_args( $this->field, array(
        'background_color'              => true,
        'background_image'              => true,
        'background_position'           => true,
        'background_repeat'             => true,
        'background_attachment'         => true,
        'background_size'               => true,
        'background_origin'             => false,
        'background_clip'               => false,
        'background_blend_mode'         => false,
        'background_gradient'           => false,
        'background_gradient_color'     => true,
        'background_gradient_direction' => true,
        'background_image_preview'      => true,
        'background_auto_attributes'    => false,
        'compact'                       => false,
        'background_image_library'      => 'image',
        'background_image_placeholder'  => esc_html__( 'Not selected', 'wpnice-accordion' ),
      ) );

      if ( $args['compact'] ) {
        $args['background_color']           = false;
        $args['background_auto_attributes'] = true;
      }

      $default_value                    = array(
        'background-color'              => '',
        'background-image'              => '',
        'background-position'           => '',
        'background-repeat'             => '',
        'background-attachment'         => '',
        'background-size'               => '',
        'background-origin'             => '',
        'background-clip'               => '',
        'background-blend-mode'         => '',
        'background-gradient-color'     => '',
        'background-gradient-direction' => '',
      );

      $default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

      $this->value = wp_parse_args( $this->value, $default_value );

      echo $this->field_before();

      echo '<div class="csf--background-colors">';

      //
      // Background Color
      if ( ! empty( $args['background_color'] ) ) {

        echo '<div class="csf--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="csf--title">'. esc_html__( 'From', 'wpnice-accordion' ) .'</div>' : '';

        CSF::field( array(
          'id'      => 'background-color',
          'type'    => 'color',
          'default' => $default_value['background-color'],
        ), $this->value['background-color'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      //
      // Background Gradient Color
      if ( ! empty( $args['background_gradient_color'] ) && ! empty( $args['background_gradient'] ) ) {

        echo '<div class="csf--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="csf--title">'. esc_html__( 'To', 'wpnice-accordion' ) .'</div>' : '';

        CSF::field( array(
          'id'      => 'background-gradient-color',
          'type'    => 'color',
          'default' => $default_value['background-gradient-color'],
        ), $this->value['background-gradient-color'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      //
      // Background Gradient Direction
      if ( ! empty( $args['background_gradient_direction'] ) && ! empty( $args['background_gradient'] ) ) {

        echo '<div class="csf--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="csf---title">'. esc_html__( 'Direction', 'wpnice-accordion' ) .'</div>' : '';

        CSF::field( array(
          'id'          => 'background-gradient-direction',
          'type'        => 'select',
          'options'     => array(
            ''          => esc_html__( 'Gradient Direction', 'wpnice-accordion' ),
            'to bottom' => esc_html__( '&#8659; top to bottom', 'wpnice-accordion' ),
            'to right'  => esc_html__( '&#8658; left to right', 'wpnice-accordion' ),
            '135deg'    => esc_html__( '&#8664; corner top to right', 'wpnice-accordion' ),
            '-135deg'   => esc_html__( '&#8665; corner top to left', 'wpnice-accordion' ),
          ),
        ), $this->value['background-gradient-direction'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      echo '</div>';

      //
      // Background Image
      if ( ! empty( $args['background_image'] ) ) {

        echo '<div class="csf--background-image">';

        CSF::field( array(
          'id'          => 'background-image',
          'type'        => 'media',
          'class'       => 'csf-assign-field-background',
          'library'     => $args['background_image_library'],
          'preview'     => $args['background_image_preview'],
          'placeholder' => $args['background_image_placeholder'],
          'attributes'  => array( 'data-depend-id' => $this->field['id'] ),
        ), $this->value['background-image'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      $auto_class   = ( ! empty( $args['background_auto_attributes'] ) ) ? ' csf--auto-attributes' : '';
      $hidden_class = ( ! empty( $args['background_auto_attributes'] ) && empty( $this->value['background-image']['url'] ) ) ? ' csf--attributes-hidden' : '';

      echo '<div class="csf--background-attributes'. esc_attr( $auto_class . $hidden_class ) .'">';

      //
      // Background Position
      if ( ! empty( $args['background_position'] ) ) {

        CSF::field( array(
          'id'              => 'background-position',
          'type'            => 'select',
          'options'         => array(
            ''              => esc_html__( 'Background Position', 'wpnice-accordion' ),
            'left top'      => esc_html__( 'Left Top', 'wpnice-accordion' ),
            'left center'   => esc_html__( 'Left Center', 'wpnice-accordion' ),
            'left bottom'   => esc_html__( 'Left Bottom', 'wpnice-accordion' ),
            'center top'    => esc_html__( 'Center Top', 'wpnice-accordion' ),
            'center center' => esc_html__( 'Center Center', 'wpnice-accordion' ),
            'center bottom' => esc_html__( 'Center Bottom', 'wpnice-accordion' ),
            'right top'     => esc_html__( 'Right Top', 'wpnice-accordion' ),
            'right center'  => esc_html__( 'Right Center', 'wpnice-accordion' ),
            'right bottom'  => esc_html__( 'Right Bottom', 'wpnice-accordion' ),
          ),
        ), $this->value['background-position'], $this->field_name(), 'field/background' );

      }

      //
      // Background Repeat
      if ( ! empty( $args['background_repeat'] ) ) {

        CSF::field( array(
          'id'          => 'background-repeat',
          'type'        => 'select',
          'options'     => array(
            ''          => esc_html__( 'Background Repeat', 'wpnice-accordion' ),
            'repeat'    => esc_html__( 'Repeat', 'wpnice-accordion' ),
            'no-repeat' => esc_html__( 'No Repeat', 'wpnice-accordion' ),
            'repeat-x'  => esc_html__( 'Repeat Horizontally', 'wpnice-accordion' ),
            'repeat-y'  => esc_html__( 'Repeat Vertically', 'wpnice-accordion' ),
          ),
        ), $this->value['background-repeat'], $this->field_name(), 'field/background' );

      }

      //
      // Background Attachment
      if ( ! empty( $args['background_attachment'] ) ) {

        CSF::field( array(
          'id'       => 'background-attachment',
          'type'     => 'select',
          'options'  => array(
            ''       => esc_html__( 'Background Attachment', 'wpnice-accordion' ),
            'scroll' => esc_html__( 'Scroll', 'wpnice-accordion' ),
            'fixed'  => esc_html__( 'Fixed', 'wpnice-accordion' ),
          ),
        ), $this->value['background-attachment'], $this->field_name(), 'field/background' );

      }

      //
      // Background Size
      if ( ! empty( $args['background_size'] ) ) {

        CSF::field( array(
          'id'        => 'background-size',
          'type'      => 'select',
          'options'   => array(
            ''        => esc_html__( 'Background Size', 'wpnice-accordion' ),
            'cover'   => esc_html__( 'Cover', 'wpnice-accordion' ),
            'contain' => esc_html__( 'Contain', 'wpnice-accordion' ),
            'auto'    => esc_html__( 'Auto', 'wpnice-accordion' ),
          ),
        ), $this->value['background-size'], $this->field_name(), 'field/background' );

      }

      //
      // Background Origin
      if ( ! empty( $args['background_origin'] ) ) {

        CSF::field( array(
          'id'            => 'background-origin',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Origin', 'wpnice-accordion' ),
            'padding-box' => esc_html__( 'Padding Box', 'wpnice-accordion' ),
            'border-box'  => esc_html__( 'Border Box', 'wpnice-accordion' ),
            'content-box' => esc_html__( 'Content Box', 'wpnice-accordion' ),
          ),
        ), $this->value['background-origin'], $this->field_name(), 'field/background' );

      }

      //
      // Background Clip
      if ( ! empty( $args['background_clip'] ) ) {

        CSF::field( array(
          'id'            => 'background-clip',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Clip', 'wpnice-accordion' ),
            'border-box'  => esc_html__( 'Border Box', 'wpnice-accordion' ),
            'padding-box' => esc_html__( 'Padding Box', 'wpnice-accordion' ),
            'content-box' => esc_html__( 'Content Box', 'wpnice-accordion' ),
          ),
        ), $this->value['background-clip'], $this->field_name(), 'field/background' );

      }

      //
      // Background Blend Mode
      if ( ! empty( $args['background_blend_mode'] ) ) {

        CSF::field( array(
          'id'            => 'background-blend-mode',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Blend Mode', 'wpnice-accordion' ),
            'normal'      => esc_html__( 'Normal', 'wpnice-accordion' ),
            'multiply'    => esc_html__( 'Multiply', 'wpnice-accordion' ),
            'screen'      => esc_html__( 'Screen', 'wpnice-accordion' ),
            'overlay'     => esc_html__( 'Overlay', 'wpnice-accordion' ),
            'darken'      => esc_html__( 'Darken', 'wpnice-accordion' ),
            'lighten'     => esc_html__( 'Lighten', 'wpnice-accordion' ),
            'color-dodge' => esc_html__( 'Color Dodge', 'wpnice-accordion' ),
            'saturation'  => esc_html__( 'Saturation', 'wpnice-accordion' ),
            'color'       => esc_html__( 'Color', 'wpnice-accordion' ),
            'luminosity'  => esc_html__( 'Luminosity', 'wpnice-accordion' ),
          ),
        ), $this->value['background-blend-mode'], $this->field_name(), 'field/background' );

      }

      echo '</div>';

      echo $this->field_after();

    }

    public function output() {

      $output    = '';
      $bg_image  = array();
      $important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
      $element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];

      // Background image and gradient
      $background_color        = ( ! empty( $this->value['background-color']              ) ) ? $this->value['background-color']              : '';
      $background_gd_color     = ( ! empty( $this->value['background-gradient-color']     ) ) ? $this->value['background-gradient-color']     : '';
      $background_gd_direction = ( ! empty( $this->value['background-gradient-direction'] ) ) ? $this->value['background-gradient-direction'] : '';
      $background_image        = ( ! empty( $this->value['background-image']['url']       ) ) ? $this->value['background-image']['url']       : '';


      if ( $background_color && $background_gd_color ) {
        $gd_direction   = ( $background_gd_direction ) ? $background_gd_direction .',' : '';
        $bg_image[] = 'linear-gradient('. $gd_direction . $background_color .','. $background_gd_color .')';
        unset( $this->value['background-color'] );
      }

      if ( $background_image ) {
        $bg_image[] = 'url('. $background_image .')';
      }

      if ( ! empty( $bg_image ) ) {
        $output .= 'background-image:'. implode( ',', $bg_image ) . $important .';';
      }

      // Common background properties
      $properties = array( 'color', 'position', 'repeat', 'attachment', 'size', 'origin', 'clip', 'blend-mode' );

      foreach ( $properties as $property ) {
        $property = 'background-'. $property;
        if ( ! empty( $this->value[$property] ) ) {
          $output .= $property .':'. $this->value[$property] . $important .';';
        }
      }

      if ( $output ) {
        $output = $element .'{'. $output .'}';
      }

      $this->parent->output_css .= $output;

      return $output;

    }

  }
}
