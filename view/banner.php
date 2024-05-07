<div class="banner">
    <div id="kb" class="carousel kb_elastic animate_text kb_wrapper" data-ride="carousel" data-interval="6000" data-pause="hover">
        <div class="carousel-inner" role="listbox">
            <?php
            $advertisements = Advertisement::getAllAdvertisement();
            if (count($advertisements) > 0) {
                $advertisement = $advertisements[0];
            ?>
                <div class="item active">
                    <img src="./images/banner/<?php echo $advertisement->hinhAnh ?>" alt="" class="img-responsive" />
                    <div class="carousel-caption kb_caption kb_caption_right">
                        <h3 data-animation="animated flipInX">
                            <?php echo $advertisement->tieuDe ?>
                        </h3>
                        <h4 data-animation="animated flipInX">
                            <?php echo $advertisement->noiDung ?>
                        </h4>
                    </div>
                </div>
                <?php
                for ($i = 1; $i < count($advertisements); $i++) {
                    $advertisement = $advertisements[$i];
                ?>
                    <div class="item">
                        <img src="./images/banner/<?php echo $advertisement->hinhAnh ?>" alt="" class="img-responsive" />
                        <div class="carousel-caption kb_caption kb_caption_right">
                            <h3 data-animation="animated fadeInDown">
                                <?php echo $advertisement->tieuDe ?>
                            </h3>
                            <h4 data-animation="animated fadeInUp">
                                <?php echo $advertisement->noiDung ?>
                            </h4>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
        <!-- Nút qua trái -->
        <a class="left carousel-control kb_control_left" href="#kb" role="button" data-slide="prev">
            <span class="fa fa-angle-left kb_icons" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <!-- Nút qua phải -->
        <a class="right carousel-control kb_control_right" href="#kb" role="button" data-slide="next">
            <span class="fa fa-angle-right kb_icons" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <script src="js/custom.js"></script>
</div>
<!-- //banner -->