jQuery(document).on('click', function(e) {
    var $this = jQuery(e.target);
    var $form = $this.closest('.caps_review_tab_options_form');
    
    if ($this.is('.caps_review_tab_enable_toprated')) {
        $form.find('.caps_review_tab_toprated_order').slideToggle($this.is(':checked'));
        $form.find('.caps_review_tab_toprated_title').slideToggle($this.is(':checked'));
    } else if ($this.is('.caps_review_tab_enable_recent')) {
        $form.find('.caps_review_tab_recent_order').slideToggle($this.is(':checked'));
        $form.find('.caps_review_tab_recent_title').slideToggle($this.is(':checked'));
    } else if ($this.is('.caps_review_tab_enable_mostvoted')) {
        $form.find('.caps_review_tab_mostvoted_order').slideToggle($this.is(':checked'));
        $form.find('.caps_review_tab_mostvoted_title').slideToggle($this.is(':checked'));
    } else if ($this.is('.caps_review_tab_enable_custom')) {
        $form.find('.caps_review_tab_custom_order').slideToggle($this.is(':checked'));
        $form.find('.caps_review_tab_custom_title').slideToggle($this.is(':checked'));
        $form.find('.caps_review_tab_custom_reviews').slideToggle($this.is(':checked'));
    } else if ($this.is('.caps_review_tab_order_header')) {
        e.preventDefault();
        $form.find('.caps_review_tab_order').slideToggle();
        $form.find('.caps_review_tab_titles').slideUp();
    } else if ($this.is('.caps_review_tab_titles_header')) {
        e.preventDefault();
        $form.find('.caps_review_tab_titles').slideToggle();
        $form.find('.caps_review_tab_order').slideUp();
    }
});