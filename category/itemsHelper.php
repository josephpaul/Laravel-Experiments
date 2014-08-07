<?php
/// create this under apps/models as itemsHelper.php

  class ItemsHelper {

    private $items;

    public function __construct($items) {
      $this->items = $items;
    }

    public function htmlList() {
      return $this->htmlFromArray($this->itemArray());
    }

    private function itemArray() {
      $result = array();
      foreach($this->items as $item) {
        if ($item->parent_id == 0) {
          $result[$item->name] = $this->itemWithChildren($item);
        }
      }
      return $result;
    }

    private function childrenOf($item) {
      $result = array();
      foreach($this->items as $i) {
        if ($i->parent_id == $item->id) {
          $result[] = $i;
        }
      }
      return $result;
    }

    private function itemWithChildren($item) {
      $result = array();
      $children = $this->childrenOf($item);
      foreach ($children as $child) {
        $result[$child->name] = $this->itemWithChildren($child);
      }
      return $result;
    }

    private function htmlFromArray($array) {
      $html = '';
      foreach($array as $k=>$v) {
        $html .= "<ul>";
        $html .= "<li>".$k."</li>";
        if(count($v) > 0) {
          $html .= $this->htmlFromArray($v);
        }
        $html .= "</ul>";
      }
      return $html;
    }
  }
  
  ?>
  
  
  
