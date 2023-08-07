import { DefaultFiles, DefaultFolders } from "./constants";

export const getFileExtension = (filename) => {
    return filename.split('.').pop();
}

export const getFileName = (path) => {
    return path.split('/').pop();
}

export const allowFileToEdit = (name) => {
    const extension = getFileExtension(name)
    switch (extension) {
        case "txt":
        case "html":
        case "js":
        case "css":
            return true;
        default:
            return false;
    }
}

export const isNotDefualtFolder = (path) => {
    return !DefaultFolders.includes(path);
}

export const isNotDefualtFile = (path) => {
    return !DefaultFiles.includes(path);
}


export const getIconClass = (name) => {
    const extension = getFileExtension(name)
    switch (extension.toLowerCase()) {
        case 'txt':
            return 'fa-solid fa-file-lines'
        case 'js': case 'css': case 'html': case 'php': case 'xml': case 'json': case 'map':
            return 'fa-solid fa-file-code'
        case 'pdf':
            return 'a-solid fa-file-pdf'
        case 'rar': case 'zip':
            return 'fa-solid fa-file-zipper'
        case 'doc': case 'docx':
            return 'fa-solid fa-file-word'
        case 'xls': case 'xlsx':
            return 'fa-solid fa-file-excel'
        case 'jpg': case 'png': case 'jpeg': case 'ico': case 'jpg': case 'gif': case 'svg':
            return 'fa-solid fa-file-image'
        case 'mp4': case 'webm': case 'mov': case 'avi': case 'wmv': case 'flv':
            return 'fa-solid fa-file-video'
        default:
            return "fa-solid fa-file";
    }
}