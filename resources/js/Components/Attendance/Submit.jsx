import Pagination from '@/Components/Pagination';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';

import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Transition } from '@headlessui/react';
import { Head, useForm } from '@inertiajs/react';
import Selectbox from '@/Components/Selectbox';
import { useState, useEffect } from 'react';


export default function SubmitAttendance() {
    const [transitioning, settransitioning] = useState(false);

    const { data, setData, post, errors, processing, recentlySuccessful } = useForm({
        status: 'attend',
        description: '',
    });

    const submit = (e) => {
        e.preventDefault();

        post(route('users.store'), {
            preserveScroll: true,
            onSuccess: () => {
                alert('User Created');
            }, onError: (errors) => {
                console.log(errors);
            }
        });
    };

    useEffect(() => {
        if (data.status === 'attend') {
            settransitioning(false);
        } else {
            settransitioning(true);
        }

    }, [data.status]);

    return (


        <form onSubmit={submit} className="mt-6 space-y-6">
            <div>
                <InputLabel htmlFor="info" value="Silahkan Lakukan Absensi" />

                <Selectbox
                    onChange={(e) => setData('status', e.target.value)}
                    className='border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full'
                    options={[
                        { value: 'attend', label: 'Hadir' },
                        { value: 'sick', label: 'Sakit' },
                        { value: 'leave', label: 'Cuti' },
                        { value: 'permit', label: 'Izin' },
                        { value: 'business_trip', label: 'Pejalanan Dinas' },
                        { value: 'remote', label: 'WFH' },
                    ]}
                />
                <InputError className="mt-2" message={errors.status} />
            </div>

            <Transition
                show={transitioning}
                enter="transition ease-in-out"
                enterFrom="opacity-0"
                leave="transition ease-in-out"
                leaveTo='opacity-0'
            >

            <div>
                <InputLabel htmlFor="description" value="Penjelasan" />


                <TextInput
                    onChange={(e) => setData('description', e.target.value)}
                    className='w-full'
                />
                <InputError className="mt-2" message={errors.descripton} />
            </div>
            </Transition>

            <div className="flex items-center gap-4">
                <PrimaryButton disabled={processing}>Absensi</PrimaryButton>
            </div>
        </form>
    );
}
