const Constants = {
    ROOT_PATH: 'dav',
    STORE_PATH: '/store/content/',
    WEBDAV_LOGIN_INFO_LINK: "https://support.bigcommerce.com/s/article/File-Access-WebDAV?language=en_US#login-info",
    MAX_FILE_SIZE_TO_UPLOAD: 250 * 1024 * 1024
};
export const DefaultFolders = [
    "dav/content",
    "dav/channel_email_templates",
    "dav/email_templates",
    "dav/exports",
    "dav/import_files",
    "dav/product_downloads",
    "dav/product_images",
    "dav/template",
    "dav/mobile_template",
    "dav/product_downloads/import",
    "dav/product_images/configured_products",
    "dav/product_images/import",
    "dav/product_images/uploaded_images",
]
export const DefaultFiles = [
    "dav/README_WebDav.txt",
]
export default Constants;