<form action="{!! route('product.search') !!}" method="get">
  <div class="field has-addons m-t-5">
    <div class="control">
      <input class="input" type="text" name="search" placeholder="Search Your Prodcuts">
    </div>
    <div class="control">
      <button type="submit" class="button is-info">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>
</form>
