<nav aria-label="Progress">
  <ol role="list"
    class="d-flex flex-column flex-md-row w-100 divide-y divide-gray-200 rounded-3 border border-gray-200 mb-4 bg-white">
    <?php foreach ($steps as $stepIdx => $step) { ?>
      <li class="position-relative d-flex flex-md-fill">
        <?php if ($step['status'] === 'complete') { ?>
          <div class="d-flex w-100 align-items-center">
            <span class="d-flex align-items-center px-4 py-3 text-sm font-weight-medium">
              <span
                class="d-flex h-7 w-7 flex-shrink-0 align-items-center justify-content-center rounded-circle <?= count($steps) === $current_step && $step['id'] === $current_step ? 'bg-success' : 'bg-primary'; ?>">
                <i class="bi bi-check-lg text-white"></i>
              </span>
              <span class="ms-2 text-sm font-weight-medium text-dark">
                <?= $step['name']; ?>
              </span>
            </span>
          </div>
        <?php } elseif ($step['status'] === 'current') { ?>
          <div class="d-flex align-items-center px-4 py-3 text-sm font-weight-medium" aria-current="step">
            <span
              class="d-flex h-7 w-7 p-2 flex-shrink-0 align-items-center justify-content-center rounded-circle border border-2 border-primary">
              <span class="text-primary">
                <?= $step['id']; ?>
              </span>
            </span>
            <span class="ms-2 text-sm font-weight-medium text-primary">
              <?= $step['name']; ?>
            </span>
          </div>
        <?php } else { ?>
          <div class="d-flex align-items-center">
            <span class="d-flex align-items-center px-4 py-3 text-sm font-weight-medium">
              <span
                class="d-flex h-7 w-7 p-2 flex-shrink-0 align-items-center justify-content-center rounded-circle border border-2 border-secondary">
                <span class="text-secondary">
                  <?= $step['id']; ?>
                </span>
              </span>
              <span class="ms-2 text-sm font-weight-medium text-secondary">
                <?= $step['name']; ?>
              </span>
            </span>
          </div>
        <?php } ?>
        <?php if ($stepIdx !== count($steps)) { ?>
          <div class="position-absolute top-0 end-0 d-none d-md-block h-100" style="width: 20px;" aria-hidden="true">
            <svg class="h-100 w-100 text-gray-300" viewBox="0 0 22 80" fill="none"
              preserveAspectRatio="none">
              <path d="M0 -2L20 40L0 82" vector-effect="non-scaling-stroke" stroke="currentColor"
                stroke-linejoin="round" />
            </svg>
          </div>
        <?php } ?>
      </li>
    <?php } ?>
  </ol>
</nav>