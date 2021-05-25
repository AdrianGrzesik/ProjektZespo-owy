<?php
ob_start();
?>
    <div class="row">
        <div class="col-md-2">
            <div class="filters">
                <h4>Filtry</h4>
                <form action="/produkty" method="get">
                    <p>Szukaj po nazwie</p>
                    <?php
                        $search_name = request::get('search_name');
                    ?>
                    <input type="text" name="search_name" value="<?php echo $search_name; ?>" />
                    <input type="submit" value="Szukaj" />
                </form>
            </div>
        </div>
        <div class="col-md-10">
            {{{content}}}
        </div>
    </div>
<?php
$content = ob_get_contents();
ob_clean();
echo views::include_to_view('frame','content', $content);
?>