import { Link } from '@inertiajs/react';

export default function Pagination({ links }) {

    return links.map((link, index) => {
        let url = link.url;
        if (link.url == null) {
            url = '#';
        }
        return (
            <div className='inline-flex mt-8 space-x-2'>
                {<Link
                    key={index}
                    href={url}
                    className={
                        link.active
                            ? 'bg-indigo-600 text-white px-4 py-2 border-indigo-600 rounded-md'
                            : 'text-indigo-600 hover:bg-indigo-600 hover:text-white px-4 py-2 border rounded-md'
                    }
                    dangerouslySetInnerHTML={{ __html: link.label }}
                />}
            </div>

        );
    });
}
