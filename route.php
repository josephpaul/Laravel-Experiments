<?php 

Route::get('/', function()
{
  $items = Item::all();
  $itemsHelper = new ItemsHelper($items);
  return View::make('hello',compact('items','itemsHelper'));
});

?>
