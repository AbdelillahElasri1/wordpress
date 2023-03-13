/* WebComponents custom elements bundle */

import type { Components, JSX } from "../../../../dist/components/types/components";

interface PrestoActionBar extends Components.PrestoActionBar, HTMLElement {}
export const PrestoActionBar: {
  prototype: PrestoActionBar;
  new (): PrestoActionBar;
};

interface PrestoActionBarController extends Components.PrestoActionBarController, HTMLElement {}
export const PrestoActionBarController: {
  prototype: PrestoActionBarController;
  new (): PrestoActionBarController;
};

interface PrestoActionBarUi extends Components.PrestoActionBarUi, HTMLElement {}
export const PrestoActionBarUi: {
  prototype: PrestoActionBarUi;
  new (): PrestoActionBarUi;
};

interface PrestoAudio extends Components.PrestoAudio, HTMLElement {}
export const PrestoAudio: {
  prototype: PrestoAudio;
  new (): PrestoAudio;
};

interface PrestoBunny extends Components.PrestoBunny, HTMLElement {}
export const PrestoBunny: {
  prototype: PrestoBunny;
  new (): PrestoBunny;
};

interface PrestoBusinessSkin extends Components.PrestoBusinessSkin, HTMLElement {}
export const PrestoBusinessSkin: {
  prototype: PrestoBusinessSkin;
  new (): PrestoBusinessSkin;
};

interface PrestoCtaOverlay extends Components.PrestoCtaOverlay, HTMLElement {}
export const PrestoCtaOverlay: {
  prototype: PrestoCtaOverlay;
  new (): PrestoCtaOverlay;
};

interface PrestoCtaOverlayController extends Components.PrestoCtaOverlayController, HTMLElement {}
export const PrestoCtaOverlayController: {
  prototype: PrestoCtaOverlayController;
  new (): PrestoCtaOverlayController;
};

interface PrestoCtaOverlayUi extends Components.PrestoCtaOverlayUi, HTMLElement {}
export const PrestoCtaOverlayUi: {
  prototype: PrestoCtaOverlayUi;
  new (): PrestoCtaOverlayUi;
};

interface PrestoDynamicOverlayUi extends Components.PrestoDynamicOverlayUi, HTMLElement {}
export const PrestoDynamicOverlayUi: {
  prototype: PrestoDynamicOverlayUi;
  new (): PrestoDynamicOverlayUi;
};

interface PrestoDynamicOverlays extends Components.PrestoDynamicOverlays, HTMLElement {}
export const PrestoDynamicOverlays: {
  prototype: PrestoDynamicOverlays;
  new (): PrestoDynamicOverlays;
};

interface PrestoEmailOverlay extends Components.PrestoEmailOverlay, HTMLElement {}
export const PrestoEmailOverlay: {
  prototype: PrestoEmailOverlay;
  new (): PrestoEmailOverlay;
};

interface PrestoEmailOverlayController extends Components.PrestoEmailOverlayController, HTMLElement {}
export const PrestoEmailOverlayController: {
  prototype: PrestoEmailOverlayController;
  new (): PrestoEmailOverlayController;
};

interface PrestoEmailOverlayUi extends Components.PrestoEmailOverlayUi, HTMLElement {}
export const PrestoEmailOverlayUi: {
  prototype: PrestoEmailOverlayUi;
  new (): PrestoEmailOverlayUi;
};

interface PrestoModernSkin extends Components.PrestoModernSkin, HTMLElement {}
export const PrestoModernSkin: {
  prototype: PrestoModernSkin;
  new (): PrestoModernSkin;
};

interface PrestoMutedOverlay extends Components.PrestoMutedOverlay, HTMLElement {}
export const PrestoMutedOverlay: {
  prototype: PrestoMutedOverlay;
  new (): PrestoMutedOverlay;
};

interface PrestoPlayer extends Components.PrestoPlayer, HTMLElement {}
export const PrestoPlayer: {
  prototype: PrestoPlayer;
  new (): PrestoPlayer;
};

interface PrestoPlayerButton extends Components.PrestoPlayerButton, HTMLElement {}
export const PrestoPlayerButton: {
  prototype: PrestoPlayerButton;
  new (): PrestoPlayerButton;
};

interface PrestoPlayerSkeleton extends Components.PrestoPlayerSkeleton, HTMLElement {}
export const PrestoPlayerSkeleton: {
  prototype: PrestoPlayerSkeleton;
  new (): PrestoPlayerSkeleton;
};

interface PrestoPlayerSpinner extends Components.PrestoPlayerSpinner, HTMLElement {}
export const PrestoPlayerSpinner: {
  prototype: PrestoPlayerSpinner;
  new (): PrestoPlayerSpinner;
};

interface PrestoSearchBar extends Components.PrestoSearchBar, HTMLElement {}
export const PrestoSearchBar: {
  prototype: PrestoSearchBar;
  new (): PrestoSearchBar;
};

interface PrestoSearchBarUi extends Components.PrestoSearchBarUi, HTMLElement {}
export const PrestoSearchBarUi: {
  prototype: PrestoSearchBarUi;
  new (): PrestoSearchBarUi;
};

interface PrestoStackedSkin extends Components.PrestoStackedSkin, HTMLElement {}
export const PrestoStackedSkin: {
  prototype: PrestoStackedSkin;
  new (): PrestoStackedSkin;
};

interface PrestoTimestamp extends Components.PrestoTimestamp, HTMLElement {}
export const PrestoTimestamp: {
  prototype: PrestoTimestamp;
  new (): PrestoTimestamp;
};

interface PrestoVideo extends Components.PrestoVideo, HTMLElement {}
export const PrestoVideo: {
  prototype: PrestoVideo;
  new (): PrestoVideo;
};

interface PrestoVideoCurtainUi extends Components.PrestoVideoCurtainUi, HTMLElement {}
export const PrestoVideoCurtainUi: {
  prototype: PrestoVideoCurtainUi;
  new (): PrestoVideoCurtainUi;
};

interface PrestoVimeo extends Components.PrestoVimeo, HTMLElement {}
export const PrestoVimeo: {
  prototype: PrestoVimeo;
  new (): PrestoVimeo;
};

interface PrestoYoutube extends Components.PrestoYoutube, HTMLElement {}
export const PrestoYoutube: {
  prototype: PrestoYoutube;
  new (): PrestoYoutube;
};

interface PrestoYoutubeSubscribeButton extends Components.PrestoYoutubeSubscribeButton, HTMLElement {}
export const PrestoYoutubeSubscribeButton: {
  prototype: PrestoYoutubeSubscribeButton;
  new (): PrestoYoutubeSubscribeButton;
};

/**
 * Utility to define all custom elements within this package using the tag name provided in the component's source. 
 * When defining each custom element, it will also check it's safe to define by:
 *
 * 1. Ensuring the "customElements" registry is available in the global context (window).
 * 2. The component tag name is not already defined.
 *
 * Use the standard [customElements.define()](https://developer.mozilla.org/en-US/docs/Web/API/CustomElementRegistry/define) 
 * method instead to define custom elements individually, or to provide a different tag name.
 */
export declare const defineCustomElements: (opts?: any) => void;

/**
 * Used to manually set the base path where assets can be found.
 * If the script is used as "module", it's recommended to use "import.meta.url",
 * such as "setAssetPath(import.meta.url)". Other options include
 * "setAssetPath(document.currentScript.src)", or using a bundler's replace plugin to
 * dynamically set the path at build time, such as "setAssetPath(process.env.ASSET_PATH)".
 * But do note that this configuration depends on how your script is bundled, or lack of
 * bunding, and where your assets can be loaded from. Additionally custom bundling
 * will have to ensure the static assets are copied to its build directory.
 */
export declare const setAssetPath: (path: string) => void;

export interface SetPlatformOptions {
  raf?: (c: FrameRequestCallback) => number;
  ael?: (el: EventTarget, eventName: string, listener: EventListenerOrEventListenerObject, options: boolean | AddEventListenerOptions) => void;
  rel?: (el: EventTarget, eventName: string, listener: EventListenerOrEventListenerObject, options: boolean | AddEventListenerOptions) => void;
  ce?: (eventName: string, opts?: any) => CustomEvent;
}
export declare const setPlatformOptions: (opts: SetPlatformOptions) => void;

export type { Components, JSX };

export * from '../../../../dist/components/types';
