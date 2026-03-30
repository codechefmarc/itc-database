<?php

/**
 * @file
 * Shared button styles between buttons and links styled as buttons.
 */

return [
  'variants' => [
    'primary'   => 'bg-cobalt-600 text-white hover:bg-cobalt-700 focus:ring-cobalt-600',
    'secondary' => 'bg-white text-navy-600 border border-slate-600 hover:bg-slate-50 focus:ring-slate-600',
    'danger'    => 'bg-crimson-600 text-white hover:bg-crimson-700 focus:ring-crimson-600',
    'ghost'     => 'bg-transparent text-navy-600 focus:ring-navy-600',
    'link'      => 'text-cobalt-500 hover:text-cobalt-800 transition-colors',
  ],
  'sizes' => [
    'sm' => 'px-3 py-1.5 text-sm',
    'md' => 'px-4 py-2 text-sm',
    'lg' => 'px-5 py-2.5 text-base',
  ],
  'base' => 'inline-flex items-center gap-2 font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 cursor-pointer disabled:cursor-not-allowed',
];
