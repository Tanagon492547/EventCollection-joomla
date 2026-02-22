<?php
defined('_JEXEC') or die;

$document = $this->app->getDocument();
$wa = $document->getWebAssetManager();
$wa->getRegistry()->addExtensionRegistryFile('mod_event_collection');
$wa->useStyle('mod_event_collection.example');

?>
<div class="w-100 d-flex justify-content-center py-5 px-4" style="background-color: <?php echo htmlspecialchars($backgroundcolor); ?>">
    <div class="collection-container-box ">
        <div class="collectionEvent" style="
    --titlecolor: <?php echo htmlspecialchars($titlecolor); ?>;
    ">
            <div class="carouse-context">
                <div class="carsouse-title">
                    <p>
                        <?php echo htmlspecialchars($evnetitle); ?>
                    </p>
                </div>
                <div class="carsouse-title">
                    <a href="<?php echo htmlspecialchars($urlallevents); ?>">ดูทั้งหมด</a>
                </div>
            </div>

            <div class="collection-container">
                <div class="collection-item">
                    <?php if (!empty($items)): ?>
                        <?php foreach ($items as $item):
                            $imgObj = json_decode($item->jcfields['image-event']->rawvalue ?? '{}');
                            $imgPath = !empty($imgObj->imagefile) ? explode('#', $imgObj->imagefile)[0] : 'images/default.jpg';
                            $urlEvent = $item->jcfields['url-event']->rawvalue ?? '#';
                            $descriptionEvent = $item->jcfields['description-event']->value ?? 'ไม่มีคำอธิบาย';
                            ?>
                            <?php if ($imgPath): ?>
                                <a href="<?php echo htmlspecialchars($urlEvent); ?>" target="_blank" rel="noopener"
                                    class="collection-card">
                                    <div class="box-description overflow-hidden">
                                        <?php echo htmlspecialchars($descriptionEvent); ?>
                                    </div>
                                    <img src="<?php echo htmlspecialchars($imgPath); ?>" alt="event image">
                                </a>
                            <?php else: ?>
                                <div class="collection-card no-image">ไม่มีรูป</div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>