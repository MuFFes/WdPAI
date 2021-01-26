<nav class="navbar">
    <div class="navbar__picker">
        <span>Choose project: </span>
        <select class="select--white">
            <option>Open Cutest</option>
        </select>
    </div>
    <div class="navbar__navigation">
        <a class="navbar__text" data-name="project"            href="">Project</a>
        <a class="navbar__text" data-name="plan"               href="">Plan</a>
        <a class="navbar__text" data-name="test-specification" href="">Test specification</a>
        <a class="navbar__text" data-name="test-execution"     href="">Test execution</a>
        <a class="navbar__icon" data-name="settings"   href=""><i class="fas fa-cog"></i></a>
        <a class="navbar__icon" data-name="users"      href=""><i class="fas fa-users"></i></a>
        <a class="navbar__icon" data-name="logout"     href="/logout"><i class="fas fa-lock"></i></a>
    </div>
</nav>

<script>
    let activeTabName = "<?php echo(ViewSupport::getActiveTab()); ?>";
    document.querySelector(`[data-name=${activeTabName}`)
        .classList.add("navbar--active");
</script>
