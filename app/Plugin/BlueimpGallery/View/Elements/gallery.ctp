<?php

    echo $this->Html->tag('div', null, array('id' => $gallery_id, 'class' => 'lightBoxGallery'));
    foreach ($images as $image) {
        extract(array_merge(array('image', 'thumb', 'title'), $image));
        $image_html = $this->Html->image($thumb, compact('title'));
        $options = array(
            'title' => $title,
            'data-gallery' => $gallery_id,
            'escape' => false,
        );
        echo $this->Html->link($image_html, $image, $options);
    }
    echo $this->Html->tag('/div');
    