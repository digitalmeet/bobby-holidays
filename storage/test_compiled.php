<?php $__env->startSection('title', $service['title'] . ' - UniWorld Holidays'); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('frontend.components.page-banner', ['title' => $service['title'], 'subtitle' => 'Our Services'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <section class="section-padding">
        <div class="container">
            <div class="row g-5">
                
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-4 p-lg-5">
                            <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                                <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:52px;height:52px;background:rgba(6,79,104,0.08);">
                                    <i class="<?php echo e($service['icon']); ?> fa-lg" style="color:#064f68;"></i>
                                </span>
                                <div>
                                    <h2 class="h4 fw-bold mb-0" style="color:#064f68;"><?php echo e($service['title']); ?></h2>
                                    <p class="text-muted mb-0 small"><?php echo e($service['short']); ?></p>
                                </div>
                            </div>
                            <div class="content-body">
                                <?php echo $service['content']; ?>

                            </div>
                        </div>
                    </div>

                    
                    <div class="card border-0 shadow-sm rounded-3 mt-4" style="background:linear-gradient(135deg, #064f68 0%, #0a7a9e 100%);">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5 class="text-white mb-1">Ready to get started?</h5>
                                    <p class="text-white-50 mb-0">Share your requirements and our team will prepare a personalised plan.</p>
                                </div>
                                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                                    <a href="<?php echo e(route('frontend.contact')); ?>" class="btn btn-light fw-semibold px-4"><i class="fa-solid fa-paper-plane me-1"></i> Enquire Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="col-lg-4">
                    <div class="sticky-top" style="top: 100px;">
                        
                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                            <div class="card-header border-0 py-3 px-4" style="background:#064f68;">
                                <h6 class="mb-0 text-white fw-semibold"><i class="fa-solid fa-list me-2"></i>All Services</h6>
                            </div>
                            <div class="list-group list-group-flush">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <a href="<?php echo e(route('frontend.service.show', $s['slug'])); ?>"
                                       class="list-group-item list-group-item-action d-flex align-items-center gap-2 py-3 px-4 <?php echo e($s['slug'] === $service['slug'] ? 'fw-bold' : ''); ?>"
                                       style="<?php echo e($s['slug'] === $service['slug'] ? 'background:rgba(6,79,104,0.06);border-left:3px solid #064f68;color:#064f68;' : ''); ?>">
                                        <i class="<?php echo e($s['icon']); ?> fa-fw <?php echo e($s['slug'] === $service['slug'] ? '' : 'text-muted'); ?>" style="<?php echo e($s['slug'] === $service['slug'] ? 'color:#064f68;' : ''); ?>"></i>
                                        <?php echo e($s['title']); ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($s['slug'] === $service['slug']): ?>
                                            <i class="fa-solid fa-chevron-right ms-auto small" style="color:#064f68;"></i>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </a>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        </div>

                        
                        <div class="card border-0 shadow-sm rounded-3 mt-4 overflow-hidden">
                            <div class="card-body text-center p-4">
                                <div class="mb-3">
                                    <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:56px;height:56px;background:rgba(6,79,104,0.08);">
                                        <i class="fa-solid fa-headset fa-lg" style="color:#064f68;"></i>
                                    </span>
                                </div>
                                <h6 class="fw-bold">Speak to an Expert</h6>
                                <p class="text-muted small mb-3">Available Mon–Sat, 9AM–7PM</p>
                                <a href="tel:<?php echo e(setting('company_phone', '+91 98765 43210')); ?>" class="btn d-block mb-2 fw-semibold text-white" style="background:#064f68;">
                                    <i class="fa-solid fa-phone me-1"></i> <?php echo e(setting('company_phone', '+91 98765 43210')); ?>

                                </a>
                                <a href="https://wa.me/<?php echo e(setting('company_whatsapp', '919876543210')); ?>" class="btn btn-outline-success d-block fw-semibold" target="_blank">
                                    <i class="fa-brands fa-whatsapp me-1"></i> WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>