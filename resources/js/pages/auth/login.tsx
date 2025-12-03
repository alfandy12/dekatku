import InputError from '@/components/input-error';
import TextLink from '@/components/text-link';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input, PasswordInput } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthLayout from '@/layouts/auth-layout';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';
import { Form, Head } from '@inertiajs/react';

interface LoginProps {
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}

export default function Login({
    status,
    canResetPassword,
    canRegister,
}: LoginProps) {
    return (
        <AuthLayout
            title="Login ke akun mu"
            description="Masukan email dan password untuk login"
        >
            <Head title="Log in" />

            <Form
                {...store.form()}
                resetOnSuccess={['password']}
                className="flex flex-col gap-6"
            >
                {({ processing, errors }) => (
                    <>
                        <div className="grid gap-5">
                            <div className="grid gap-2">
                                <Label
                                    htmlFor="email"
                                    className="font-medium text-gray-200"
                                >
                                    Email Address
                                </Label>
                                <Input
                                    id="email"
                                    type="email"
                                    name="email"
                                    required
                                    autoFocus
                                    tabIndex={1}
                                    autoComplete="email"
                                    placeholder="email@example.com"
                                    className="border-gray-700 bg-gray-800/50 text-white placeholder:text-gray-500 focus-visible:border-purple-400 focus-visible:ring-purple-400/30"
                                />
                                <InputError message={errors.email} />
                            </div>

                            <div className="grid gap-2">
                                <Label
                                    htmlFor="password"
                                    className="font-medium text-gray-200"
                                >
                                    Password
                                </Label>
                                <PasswordInput
                                    id="password"
                                    name="password"
                                    required
                                    tabIndex={2}
                                    autoComplete="current-password"
                                    placeholder="Enter your password"
                                    className="border-gray-700 bg-gray-800/50 text-white placeholder:text-gray-500 focus-visible:border-purple-400 focus-visible:ring-purple-400/30"
                                />
                                <InputError message={errors.password} />
                                {canResetPassword && (
                                    <TextLink
                                        href={request()}
                                        className="text-sm text-purple-400 transition-colors hover:text-purple-300"
                                        tabIndex={5}
                                    >
                                        Forgot password?
                                    </TextLink>
                                )}
                            </div>

                            <div className="flex items-center space-x-3">
                                <Checkbox
                                    id="remember"
                                    name="remember"
                                    tabIndex={3}
                                    className="border-gray-600 data-[state=checked]:border-purple-500 data-[state=checked]:bg-purple-500"
                                />
                                <Label
                                    htmlFor="remember"
                                    className="cursor-pointer font-normal text-gray-300"
                                >
                                    Remember me for 30 days
                                </Label>
                            </div>

                            <Button
                                type="submit"
                                className="mt-2 h-11 w-full bg-gradient-to-r from-purple-500 to-pink-500 font-semibold text-white shadow-lg shadow-purple-500/30 transition-all duration-300 hover:from-purple-600 hover:to-pink-600"
                                tabIndex={4}
                                disabled={processing}
                                data-test="login-button"
                            >
                                {processing && <Spinner className="mr-2" />}
                                {processing ? 'Signing in...' : 'Sign in'}
                            </Button>
                        </div>

                        {canRegister && (
                            <div className="border-t border-gray-700/50 pt-4 text-center">
                                <p className="text-sm text-gray-400">
                                    Tidak memiliki akun?{' '}
                                    <TextLink
                                        href={register()}
                                        tabIndex={5}
                                        className="font-medium text-purple-400 transition-colors hover:text-purple-300"
                                    >
                                        Sign up now
                                    </TextLink>
                                </p>
                            </div>
                        )}
                    </>
                )}
            </Form>

            {status && (
                <div className="mb-4 text-center text-sm font-medium text-green-600">
                    {status}
                </div>
            )}
        </AuthLayout>
    );
}
