<?php

namespace App\View\Components\Checkouts;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Provides a device modal for adding additional device details for new devices.
 */
class DeviceModal extends Component {

  /**
   * Create a new component instance.
   */
  public function __construct() {

  }

  /**
   * Get the view / contents that represent the component.
   */
  public function render(): View|\Closure|string {
    return view('components.checkouts.device-modal');
  }

}
