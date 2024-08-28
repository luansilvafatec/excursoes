import './bootstrap';

import Alpine from 'alpinejs'
import mask from '@alpinejs/mask'
import Clipboard from '@ryangjchandler/alpine-clipboard'


Alpine.plugin(mask)
Alpine.plugin(Clipboard)

window.Alpine = Alpine

Alpine.start()


