import Pagination from '@/Components/Pagination';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import { Head, Link } from '@inertiajs/react';

export default function AttendanceIndex({ auth, attendances }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Attendances
                </h2>
            }
        >
            <Head title="Attendances" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className='flex justify-between mb-3 item-center'>
                        <label className='text-lg font-semibold font-bold'>Total : {attendances.total}</label>
                    </div>
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <table className='min-w-full'>
                                <thead>
                                    <tr className='border-b-2'>
                                        <th className='px-6 py-3 text-left text-lg font-medium text-black'>Tanggal</th>
                                        <th className='px-6 py-3 text-left text-lg font-medium text-black'>Name</th>
                                        <th className='px-6 py-3 text-left text-lg font-medium text-black'>Status</th>
                                        <th className='px-6 py-3 text-left text-lg font-medium text-black'>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {attendances.data.map((attendance) => (
                                        <tr key={attendance.id} className='border-b add:bg-white even:bg-slate-200'>
                                            <td className='px-6 py-4'>{attendance.created_at}</td>
                                            <td className='px-6 py-4'>{attendance.user.name}</td>
                                            <td className='px-6 py-4'>{attendance.status}</td>
                                            <td className='px-6 py-4'>{attendance.latitude},{attendance.longitude}</td>
                                        </tr>
                                    ))}

                                </tbody>
                            </table>
                            <Pagination links={attendances.links} />
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
