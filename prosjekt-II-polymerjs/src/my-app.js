/**
 * @license
 * Copyright (c) 2016 The Polymer Project Authors. All rights reserved.
 * This code may only be used under the BSD style license found at http://polymer.github.io/LICENSE.txt
 * The complete set of authors may be found at http://polymer.github.io/AUTHORS.txt
 * The complete set of contributors may be found at http://polymer.github.io/CONTRIBUTORS.txt
 * Code distributed by Google as part of the polymer project is also
 * subject to an additional IP rights grant found at http://polymer.github.io/PATENTS.txt
 */

import { PolymerElement, html } from '@polymer/polymer/polymer-element.js';
import { setPassiveTouchGestures, setRootPath } from '@polymer/polymer/lib/utils/settings.js';
import '@polymer/app-layout/app-drawer/app-drawer.js';
import '@polymer/app-layout/app-drawer-layout/app-drawer-layout.js';
import '@polymer/app-layout/app-header/app-header.js';
import '@polymer/app-layout/app-header-layout/app-header-layout.js';
import '@polymer/app-layout/app-scroll-effects/app-scroll-effects.js';
import '@polymer/app-layout/app-toolbar/app-toolbar.js';
import '@polymer/app-route/app-location.js';
import '@polymer/app-route/app-route.js';
import '@polymer/iron-pages/iron-pages.js';
import '@polymer/iron-selector/iron-selector.js';
import '@polymer/paper-icon-button/paper-icon-button.js';
import './my-icons.js';
import './user-handler.js';
import store from './redux/store/index.js';

setPassiveTouchGestures(true);

setRootPath(MyAppGlobals.rootPath);

class MyApp extends PolymerElement {
  static get template() {
    return html`
      <style>
        :host {
          --app-primary-color: #008ECC;
          --app-secondary-color: black;
          display: block;
          font-family: Georgia;
          margin: 5px;
          padding: 5px;
        }

        app-drawer-layout:not([narrow]) [drawer-toggle] {
          display: none;
          
        }

        app-header {
          padding: 40px;
          color: white;
          background-color: var(--app-primary-color);
        }

        app-header paper-icon-button {
          --paper-icon-button-ink-color: white;
        }

        .drawer-list {
          margin: 20px;
          padding: 20px;
          
        }

        .drawer-list a {
          display: block;
          padding: 20px;
          text-decoration: none;
          color: var(--app-secondary-color);
          line-height: 20px;
          color: #008ECC;
        }

        .drawer-list a.iron-selected {
          margin: 20px;
          font-size: 15px;
          font-weight: bold;
          font-family: Georgia;
          color: #008ECC;
          border-bottom: 2px solid #008ECC;
          width: 130px;
        }

        div#title {
          margin: 5px;
          font-size: 40px;
          font-family: Georgia;
        }

       
      </style>

      <app-location route="{{route}}" url-space-regex="^[[rootPath]]">
      </app-location>

      <app-route route="{{route}}" pattern="[[rootPath]]:page" data="{{routeData}}" tail="{{subroute}}">
      </app-route>

      <app-drawer-layout fullbleed="" narrow="{{narrow}}">
        <!-- Drawer content -->
        <app-drawer id="drawer" slot="drawer" swipe-open="[[narrow]]">
          <app-toolbar>Choose your action</app-toolbar>
          <iron-selector selected="[[page]]" attr-for-selected="name" class="drawer-list" role="navigation">
            <a name="view1" href="[[rootPath]]view1">Video view</a>  
          <template is="dom-if" if="{{user.isAdmin}}">
              <a name="view5" href="[[rootPath]]view5">Request</a>
            </template>
            <template is="dom-if" if="{{user.isTeacher}}">
              <a name="view2" href="[[rootPath]]view2">Video upload</a>
              <a name="view4" href="[[rootPath]]view4">Teacher playlist</a>
            </template>
            <template is="dom-if" if="{{user.isStudent}}">
              <a name="view3" href="[[rootPath]]view3">Student playlist</a>
            </template>
          </iron-selector>
        </app-drawer>

        <!-- Main content -->
        <app-header-layout has-scrolling-region="">

          <app-header slot="header" condenses="" reveals="" effects="waterfall">
            <app-toolbar>
              <paper-icon-button icon="my-icons:menu" drawer-toggle=""></paper-icon-button>
              <div main-title id="title">Prosjekt II</div>
              <user-handler></user-handler>
            </app-toolbar>
          </app-header>

          <iron-pages selected="[[page]]" attr-for-selected="name" role="main">
            <video-view name="view1"></video-view>
            <video-upload name="view2"></video-upload>
            <student-playlist name="view3"></student-playlist>
            <teacher-playlist name="view4"></teacher-playlist>
            <admin-request name="view5"></admin-request>
            <my-view404 name="view404"></my-view404>
          </iron-pages>
        </app-header-layout>
      </app-drawer-layout>
    `;
  }

  constructor() {
    super();
    const data = store.getState();
    this.user = data.user;
    store.subscribe(()=>{
      this.user = store.getState().user;
      console.log(this.user);
    })
  }

  static get properties() {
    return {
      page: {
        type: String,
        reflectToAttribute: true,
        observer: '_pageChanged'
      },
      routeData: Object,
      subroute: Object,
      user: {
        type: Object,
        value: {student: false, teacher: false, admin: false}
      }
    };
  }

  static get observers() {
    return [
      '_routePageChanged(routeData.page)'
    ];
  }

  _routePageChanged(page) {
    if (!page) {
      this.page = 'view1';
    } else if (['view1', 'view2', 'view3', 'view4', 'view5', 'view404'].indexOf(page) !== -1) {
      this.page = page;
    } else {
      this.page = 'view404';
    }
    if (!this.$.drawer.persistent) {
      this.$.drawer.close();
    }
  }

  _pageChanged(page) {
    switch (page) {
      case 'view1':
        import('./video-view.js');
        break;
      case 'view2':
        import('./video-upload.js');
        break;
      case 'view3':
        import('./student-playlist.js');
        break;
      case 'view4':
        import('./teacher-playlist.js');
        break;
      case 'view5':
        import('./admin-request.js');
        break;
      case 'view404':
        import('./my-view404.js');
        break;
    }
  }
}

window.customElements.define('my-app', MyApp);
